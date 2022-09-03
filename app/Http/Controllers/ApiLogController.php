<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use Illuminate\Http\Request;

class ApiLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = ApiLog::all();
        return view('logs')->with(compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sessionId)
    {
        $body = $request->getContent();
        $data = json_decode(json_encode($body), true);

        $log = new ApiLog;

        $log->session_id = $sessionId;
        $log->endpoint = $request->path();
        $log->req_timestamp = now();
        $log->rsp_timestamp = "";
        $log->duration = 0;
        $log->req = $data;
        $log->rsp = "";
        $log->created_at = now();
        $log->updated_at = now();

        $log->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApiLog  $apiLog
     * @return \Illuminate\Http\Response
     */
    public function show(ApiLog $apiLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApiLog  $apiLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiLog $apiLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApiLog  $apiLog
     * @return \Illuminate\Http\Response
     */
    public function update($apiLog, $flowResponse)
    {
        $flowResponse = json_encode($flowResponse);
        (new ApiLog)->updateLog($apiLog->id, $apiLog->req_timestamp, $flowResponse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApiLog  $apiLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiLog $apiLog)
    {
        //
    }

    public function getAllLogs()
    {
        $result = (new ApiLog)->getAllLogs();
        return $result;
    }
}
