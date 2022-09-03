<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoke extends Model
{
    use HasFactory;

    public function getInvokeDetails($flowId, $flowNodeId)
    {
        $result = Invoke::where(['flow_id' => $flowId, 'flow_node_id' => $flowNodeId])->first();
        if ($result)
            return $result;
        else return null;
    }
}
