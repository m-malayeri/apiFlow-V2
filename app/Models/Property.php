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

    public function getPropertyDetails($flowId, $sessionId, $propertyName)
    {
        $result = Property::where(['flow_id' => $flowId,  'session_id' => $sessionId, 'property_name' => $propertyName])->first();
        if ($result)
            return $result;
        else return null;
    }

    public function getFlowProperties($sessionId, $lastActionId)
    {
        $result = Property::where(['session_id' => $sessionId, 'flow_node_id' => $lastActionId])->get();
        if ($result)
            return $result;
        else return null;
    }
}
