<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvokeOutput extends Model
{
    use HasFactory;

    public function getInvokeOutputs($invokeId)
    {
        $result = InvokeOutput::where('invoke_id', $invokeId)->get();
        if ($result)
            return $result;
        else return null;
    }

    public function getFlowInvokeOutputs($flowId)
    {
        $result = InvokeOutput::where('flow_id', $flowId)->get();
        if ($result)
            return $result;
        else return null;
    }
}
