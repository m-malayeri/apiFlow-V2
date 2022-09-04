<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiSessionController extends Controller
{
    public function store(Request $request)
    {
        $flow_name = explode("/", $request->path());
        $flow_name = $flow_name[1];

        $session = new Session;

        $session->flow_name = $flow_name;
        $session->src_ip = $request->ip();
        $session->created_at = now();
        $session->updated_at = now();

        $session->save();
        return Session::get()->last()->id;
    }

    public function destroy($id)
    {
        Session::where('id', $id)->delete();
    }
}
