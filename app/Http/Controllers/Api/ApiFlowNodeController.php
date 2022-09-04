<?php

namespace App\Http\Controllers\Api;

use  App\Models\FlowNode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiFlowNodeController extends Controller
{
    public function getFlowNodes($flowId)
    {
        $result = FlowNode::where('flow_id', $flowId)->get();
        if ($result)
            return $result;
        else return null;
    }

    public function getLastNodeId($flowId)
    {
        $result = FlowNode::where(['flow_id' => $flowId])->first()->id;
        return $result;
    }

    public function getFirstNodeId($flowId)
    {
        $result = FlowNode::where(['flow_id' => $flowId, 'node_name' => "Start"])->first()->id;
        return $result;
    }
}
