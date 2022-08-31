<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    use HasFactory;

    public function getDecisionLines($flowNodeId)
    {
        $result = Decision::where('flow_node_id', $flowNodeId)->get();
        if (isset($result))
            return $result;
        else return null;
    }

    public function getDecisionDetails($decisionId)
    {
        $result = Decision::where('id', $decisionId)->get();
        if (isset($result))
            return $result[0];
        else return null;
    }

    public function getFlowDecisions($flowId)
    {
        $result = Decision::where('flow_id', $flowId)->get();
        if (isset($result))
            return $result;
        else return null;
    }

    public function store($request)
    {
        $array = array(
            'flow_id' => $request->input('flow_id'),
            'flow_node_id' => $request->input('flow_node_id'),
            'prop_name' => $request->input('prop_name'),
            'decision_type' => $request->input('decision_type'),
            'prop_value' => $request->input('prop_value'),
            'next_node_id' => $request->input('next_node_id'),
            'created_at' => now(),
            'updated_at' => now()
        );
        Decision::insert($array);
        $decisionId = Decision::get()->last()->id;
        return $decisionId;
    }
}
