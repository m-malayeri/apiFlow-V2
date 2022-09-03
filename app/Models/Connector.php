<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connector extends Model
{
    use HasFactory;

    public function getNextNodeId($flowNodeId, $nodeType)
    {
        $result = Connector::where(['src_id' => $flowNodeId, 'src_type' => $nodeType])->first();
        if (isset($result))
            return $result;
        else return null;
    }

    public function getFlowConnectors($flowId)
    {
        $result = Connector::where('flow_id', $flowId)->get();
        if (isset($result))
            return $result;
        else return null;
    }
}
