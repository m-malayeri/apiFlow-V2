<?php

namespace App\Http\Controllers\Api;

use App\Models\Connector;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiConnectorController extends Controller
{
    public function getNextNodeId($flowNodeId, $nodeType)
    {
        $result = Connector::where(['src_id' => $flowNodeId, 'src_type' => $nodeType])->first();
        if ($result)
            return $result;
        else return null;
    }

    public function getFlowConnectors($flowId)
    {
        $result = Connector::where('flow_id', $flowId)->get();
        if ($result)
            return $result;
        else return null;
    }
}
