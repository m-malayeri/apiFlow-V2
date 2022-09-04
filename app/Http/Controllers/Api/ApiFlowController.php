<?php

namespace App\Http\Controllers\Api;

use App\Models\Flow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiFlowController extends Controller
{
    public function show($flowName)
    {
        $result = Flow::where('flow_name', $flowName)->first();
        if ($result)
            return $result;
        else return null;
    }
}
