<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Decision;
use Illuminate\Http\Request;

class ApiDecisionController extends Controller
{
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
}
