<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;

    public function updateLog($id, $reqTimestamp, $flowResponse)
    {
        $duration = now()->diffInMilliSeconds($reqTimestamp);
        ApiLog::where('id', $id)->update(['rsp_timestamp' => now(), 'duration' => $duration, 'rsp' => $flowResponse]);
    }
}
