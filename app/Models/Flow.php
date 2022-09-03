<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    use HasFactory;

    public function getFlowDetailsByName($flowName)
    {
        $result = Flow::where('flow_name', $flowName)->first();
        if ($result)
            return $result;
        else return null;
    }
}
