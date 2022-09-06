<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiLogController;

use App\Http\Controllers\Api\ApiPropertyController;
use App\Http\Controllers\Api\ApiSessionController;
use App\Http\Controllers\Api\ApiFlowController;
use App\Http\Controllers\Api\ApiFlowNodeController;
use App\Http\Controllers\Api\ApiDecisionController;
use App\Http\Controllers\Api\ApiConnectorController;
use App\Http\Controllers\Api\ApiInvokeController;
use App\Http\Controllers\Api\ApiInvokeInputController;
use App\Http\Controllers\Api\ApiInvokeOutputController;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function execute($flowName, Request $request)
    {
        // Prepare final flow response
        $flowResponse = new \stdClass();
        $flowResponse->ResponseCode = "";
        $flowResponse->ResponseDescription = "";
        $resCode = "";
        $resDesc = "";

        // Log session
        $sessionId = (new ApiSessionController)->store($request);

        // Log REQ in API Logs
        $apiLog = (new ApiLogController)->store($request, $sessionId);

        // Get flow details
        $flowDetails = (new ApiFlowController)->show($flowName);

        if ($flowDetails === null) {
            $resCode = "-100";
            $resDesc = "Flow not found, please check flow name";
        } else {
            if ($flowDetails->status == "Enabled") {

                $flowNodes = (new ApiFlowNodeController)->getFlowNodes($flowDetails->id);
                $currentNodeId = (new ApiFlowNodeController)->getFirstNodeId($flowDetails->id);

                $end = false;
                $forceEnd = false;

                while ($end == false && $forceEnd == false) {
                    $flowNode = $flowNodes->where('id', $currentNodeId)->first();
                    $nodeType = $flowNode->node_type;
                    $nodeSubType = $flowNode->sub_type;
                    if ($nodeType == "Start") {
                        // If this is the start point of flow, move to next node
                        $currentNodeId =  (new ApiConnectorController)->getNextNodeId($flowNode->id, "Start")->target_id;
                    } else if ($nodeType == "Action") {
                        // Different sub types can lead to different actions such as "Invoke", "Query" , ...
                        if ($nodeSubType == "Invoke") {
                            // Get invoke details
                            $invokeDetails = (new ApiInvokeController)->getInvokeDetails($flowDetails->id, $flowNode->id);
                            $invokeInputs = (new ApiInvokeInputController)->getInvokeInputs($invokeDetails->id);
                            $invokeOutputs = (new ApiInvokeOutputController)->getInvokeOutputs($invokeDetails->id);

                            if (isset($invokeDetails) && isset($invokeInputs) && isset($invokeOutputs)) {
                                // Invoke
                                $invokeResults = $this->invoke($request, $invokeDetails, $invokeInputs);
                                // Log properties
                                (new ApiPropertyController)->store($invokeResults, $invokeOutputs, $sessionId, $flowDetails->id);
                            } else {
                                // In this case, one or more invoke entities are not configured correcylt and flow execution is failed
                                $resCode = "-110";
                                $resDesc = "Flow execution failed, please check invoke configurations";
                                $forceEnd = true;
                            }
                        }
                        $currentNodeId =  (new ApiConnectorController)->getNextNodeId($flowNode->id, "Invoke")->target_id;
                    } else if ($nodeType == "Decision") {
                        // Get decision lines
                        $decisionLines = (new ApiDecisionController)->getDecisionLines($flowNode->id);
                        $finalResults = collect([]);
                        foreach ($decisionLines as $decisionLine) {
                            // Get property details
                            $propertyDetails = (new ApiPropertyController)->getPropertyDetails($flowDetails->id, $sessionId, $decisionLine->prop_name);

                            // Decide and find next node id
                            $decisionResult = $this->decide($propertyDetails, $decisionLine);

                            $finalResult = new \stdClass();
                            $finalResult->node_id = $flowNode->id;
                            $finalResult->decision_id = $decisionLine->id;
                            $finalResult->result = $decisionResult;
                            $finalResults->push($finalResult);
                        }
                        $successCount = count($finalResults->where('result', true));
                        if ($successCount == 1) {
                            // In this case, only one decision result is true and flow execution can continue
                            $successNode = $finalResults->where('result', true)->first()->decision_id;
                            $currentNodeId =  (new ApiDecisionController)->getDecisionDetails($successNode)->next_node_id;
                        } else {
                            // In this case, more than one decision result is true and flow execution is failed
                            $resCode = "-115";
                            $resDesc = "Flow execution failed, please check decision configurations";
                            $forceEnd = true;
                        }
                    } else if ($nodeType == "End") {
                        $resCode = "0";
                        $resDesc = "Flow execution completed successfully";
                        $end = true;
                    }
                }

                // Append last action result into main response
                if (isset($invokeResults)) {
                    $invokeResults = json_decode($invokeResults);
                    $flowResponse->LastActionResult = $invokeResults;
                }

                // Decide flow response code in case of flow failure
                if ($resCode == "") {
                    $resCode = "-120";
                    $resDesc = "Unknown flow response, please contact administrator";
                }

                // Clear sessions and properties based on flow config
                if ($flowDetails->log_level == "Property") {
                    (new ApiSessionController)->destroy($sessionId);
                } else if ($flowDetails->log_level == "Session") {
                    (new ApiPropertyController)->destroy($sessionId);
                } else if ($flowDetails->log_level == "None") {
                    (new ApiSessionController)->destroy($sessionId);
                    (new ApiPropertyController)->destroy($sessionId);
                }

                // Update RSP and calculate duration
                (new ApiLogController)->update($apiLog, $flowResponse);
            } else {
                $resCode = "-105";
                $resDesc = "Flow is disabled, please enable it via GUI";
            }
        }

        $flowResponse->ResponseCode = $resCode;
        $flowResponse->ResponseDescription = $resDesc;
        return response()->json($flowResponse);
    }

    public function invoke($request, $invokeDetails, $invokeInputs)
    {
        // Build request body
        foreach ($invokeInputs as $invokeInput) {
            $inputType = $invokeInput->input_type;
            $parentObject = $invokeDetails->req_parent_object;

            if ($inputType == "User") {
                if ($parentObject != "")
                    $req[$parentObject][$invokeInput->input_name] = $request[$invokeInput->api_input_name];
                else
                    $req[$invokeInput->input_name] = $request[$invokeInput->api_input_name];
            } else if ($inputType == "Literal") {
                if ($parentObject != "")
                    $req[$parentObject][$invokeInput->input_name] = $invokeInput->literal_value;
                else
                    $req[$invokeInput->input_name] = $invokeInput->literal_value;
            }
        }

        $req = json_encode($req);
        $auth = $invokeDetails->user . ":" . $invokeDetails->password;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $invokeDetails->url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:' . $invokeDetails->content_type));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $invokeResults = curl_exec($ch);
        curl_close($ch);

        if (isset($invokeResults))
            return $invokeResults;
        else
            return null;
    }

    public function decide($propertyDetails, $decisionDetails)
    {
        // Decide current decision based on user configuration and property values
        $successFlag = false;
        if (isset($propertyDetails) && isset($decisionDetails)) {
            $decisionType = $decisionDetails->decision_type;
            $decisionValue = $decisionDetails->prop_value;
            $propertyValue = $propertyDetails->property_value;
            switch ($decisionType) {
                case "Equal":
                    if ($propertyValue ==  $decisionValue)
                        $successFlag = true;
                    break;
                case "Not Equal":
                    if ($propertyValue !=  $decisionValue)
                        $successFlag = true;
                    break;
                case "Greater Than":
                    if ($propertyValue >  $decisionValue)
                        $successFlag = true;
                    break;
                case "Less Than":
                    if ($propertyValue <  $decisionValue)
                        $successFlag = true;
                    break;
            }
        }
        return $successFlag;
    }
}
