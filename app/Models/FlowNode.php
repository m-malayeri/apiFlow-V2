<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowNode extends Model
{
    use HasFactory;

    public function init($flowId)
    {
        $array = array(
            'flow_id' => $flowId,
            'node_name' => "Start",
            'node_type' => "Start",
            'sub_type' => "",
            'created_at' => now(),
            'updated_at' => now()
        );
        FlowNode::insert($array);
        $flowNodeId = FlowNode::get()->last()->id;
        return $flowNodeId;
    }
}
