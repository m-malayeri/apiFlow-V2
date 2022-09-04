<?php

namespace App\Http\Controllers\Api;

use App\Models\InvokeInput;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiInvokeInputController extends Controller
{
    public function getInvokeInputs($invokeId)
    {
        $result = InvokeInput::where('invoke_id', $invokeId)->get();
        if ($result)
            return $result;
        else return null;
    }
}
