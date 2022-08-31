<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public function store($data)
    {
        Session::insert($data);
        return Session::get()->last()->id;
    }

    public function getAllSessions()
    {
        // Query all sessions 
        $result = Session::get();
        return $result;
    }
}
