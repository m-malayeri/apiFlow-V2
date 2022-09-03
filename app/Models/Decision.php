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
}
