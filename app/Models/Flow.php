<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasFactory;

    public function getFlowDetailsByName($flowName)
    {
        $result = Flow::where('flow_name', $flowName)->get();
        if (isset($result))
            return $result[0];
        else return null;
    }

    public function getFlowDetailsById($flowId)
    {
        $result = Flow::where('id', $flowId)->get();
        if (isset($result))
            return $result[0];
        else return null;
    }

    public function getAllFlows()
    {
        // Query all flows 
        $result = Flow::get();
        return $result;
    }
    public function store($request)
    {
        $array = array(
            'flow_name' => $request->input('flow_name'),
            'status' => "Enabled",
            'log_level' => $request->input('log_level'),
            'created_at' => now(),
            'updated_at' => now()
        );

        $result = Flow::where('flow_name', $request->input('flow_name'))->get('id');
        if (isset($result)) {
            return null;
        } else {
            Flow::insert($array);
            $flowId = Flow::get()->last()->id;
            return $flowId;
        }
    }

    public function disable($flowId)
    {
        Flow::where('id', $flowId)->update(['status' => "Disabled"]);
    }

    public function enable($flowId)
    {
        Flow::where('id', $flowId)->update(['status' => "Enabled"]);
    }

    public function show($flowId)
    {
        $result = Flow::where('id', $flowId)->first();
        if (isset($result))
            return $result;
        else return null;
    }
}
