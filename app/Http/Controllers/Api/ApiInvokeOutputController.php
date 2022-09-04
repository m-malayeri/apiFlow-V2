<?php

namespace App\Http\Controllers\Api;

use App\Models\InvokeOutput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiInvokeOutputController extends Controller
{
    public function getInvokeOutputs($invokeId)
    {
        $result = InvokeOutput::where('invoke_id', $invokeId)->get();
        if ($result)
            return $result;
        else return null;
    }
}
