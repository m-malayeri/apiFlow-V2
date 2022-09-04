<?php

namespace App\Http\Controllers\Api;

use App\Models\Property;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiPropertyController extends Controller
{
    public function store($invokeResults, $invokeOutputs, $sessionId, $flowId)
    {
        foreach (json_decode($invokeResults) as $propName => $propValue) {
            foreach ($invokeOutputs as $invokeOutput) {
                if ($invokeOutput->output_name == $propName) {

                    $array = array(
                        'flow_id' => $flowId,
                        'session_id' => $sessionId,
                        'property_name' => $invokeOutput->save_as_prop_name,
                        'property_value' => $propValue,
                        'created_at' => now(),
                        'updated_at' => now()
                    );

                    $result = Property::where(['flow_id' => $flowId, 'session_id' => $sessionId, 'property_name' => $invokeOutput->save_as_prop_name])->first();
                    if ($result === null) {
                        Property::insert($array);
                    } else {
                        Property::where('id', $result->id)->update(['property_value' => $propValue]);
                    }
                }
            }
        }
    }

    public function getPropertyDetails($flowId, $sessionId, $propertyName)
    {
        $result = Property::where(['flow_id' => $flowId,  'session_id' => $sessionId, 'property_name' => $propertyName])->first();
        if ($result)
            return $result;
        else return null;
    }

    public function destroy($id)
    {
        Property::where('session_id', $id)->delete();
    }
}
