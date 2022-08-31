<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvokeInput extends Model
{
    use HasFactory;

    public function getInvokeInputs($invokeId)
    {
        $result = InvokeInput::where('invoke_id', $invokeId)->get();
        if (isset($result))
            return $result;
        else return null;
    }

    public function getFlowInvokeInputs($flowId)
    {
        $result = InvokeInput::where('flow_id', $flowId)->get();
        if (isset($result))
            return $result;
        else return null;
    }
}
