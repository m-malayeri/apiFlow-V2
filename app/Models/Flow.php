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
}
