<?php

namespace App\Http\Controllers\Api;

use App\Models\Invoke;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiInvokeController extends Controller
{
    public function getInvokeDetails($flowId, $flowNodeId)
    {
        $result = Invoke::where(['flow_id' => $flowId, 'flow_node_id' => $flowNodeId])->first();
        if ($result)
            return $result;
        else return null;
    }
}
