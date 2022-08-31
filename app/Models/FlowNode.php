<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowNode extends Model
{
    use HasFactory;

    public function getFlowNodes($flowId)
    {
        $result = FlowNode::where('flow_id', $flowId)->get();
        if (isset($result))
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

    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'node_name' => $request->input('node_name'),
            'node_type' => $request->input('node_type'),
            'sub_type' => $request->input('sub_type'),
            'created_at' => now(),
            'updated_at' => now()
        );
        FlowNode::insert($array);
        $flowNodeId = FlowNode::get()->last()->id;
        return $flowNodeId;
    }

    public function init($flowId)
    {
        $array = array(
            'flow_id' => $flowId,
            'node_name' => "Start",
            'node_type' => "Start",
            'sub_type' => "",
            'created_at' => now(),
            'updated_at' => now()
        );
        FlowNode::insert($array);
        $flowNodeId = FlowNode::get()->last()->id;
        return $flowNodeId;
    }
}