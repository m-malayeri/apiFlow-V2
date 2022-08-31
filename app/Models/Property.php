<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'propertys';

    public function store($invokeResults, $invokeOutputs, $sessionId, $flowId)
    {
        foreach (json_decode($invokeResults) as $propName => $propValue) {
            foreach ($invokeOutputs as $invokeOutput) {
                if ($invokeOutput->output_name == $propName) {

                    $array = array(
                        'flow_id' => $flowId,
                        'session_id' => $sessionId,
                        'property_name' => $invokeOutput->save_as_prop_name,
                        'property_value' => $propValue,
                        'created_at' => now(),
                        'updated_at' => now()
                    );

                    $result = Property::where(['flow_id' => $flowId, 'session_id' => $sessionId, 'property_name' => $invokeOutput->save_as_prop_name])->first();
                    if ($result === null) {
                        Property::insert($array);
                    } else {
                        Property::where('id', $result->id)->update(['property_value' => $propValue]);
                    }
                }
            }
        }
    }

    public function getPropertyDetails($flowId, $sessionId, $propertyName)
    {
        $result = Property::where(['flow_id' => $flowId,  'session_id' => $sessionId, 'property_name' => $propertyName])->first();
        if (isset($result))
            return $result;
        else return null;
    }

    public function getFlowProperties($sessionId, $lastActionId)
    {
        $result = Property::where(['session_id' => $sessionId, 'flow_node_id' => $lastActionId])->get();
        if (isset($result))
            return $result;
        else return null;
    }
}
