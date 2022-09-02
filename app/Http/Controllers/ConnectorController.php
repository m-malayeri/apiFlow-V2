<?php

namespace App\Http\Controllers;

use App\Models\Flow;
use App\Models\Connector;
use Illuminate\Http\Request;

class ConnectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)
    {
        $connectors = Connector::where('flow_id', $flow->id)->get();
        return view('connectors')->with(compact('flow', 'connectors'));
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
    public function store(Request $request)
    {
        $connector = new Connector;

        $connector->flow_id = $request->input('flow_id');
        $connector->src_type = $request->input('src_type');
        $connector->src_id = $request->input('src_id');
        $connector->target_type = $request->input('target_type');
        $connector->target_id = $request->input('target_id');
        $connector->created_at = now();
        $connector->updated_at = now();

        $connector->save();
        return redirect(url()->previous())->withMessage('Connector record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function show(Connector $connector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function edit(Connector $connector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Connector $connector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Connector  $connector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Connector $connector)
    {
        $connector->delete();
        return redirect(url()->previous())->withMessage('Connector record deleted successfully');
    }

    public function getNextNodeId($flowNodeId, $nodeType)
    {
        $result = (new Connector)->getNextNodeId($flowNodeId, $nodeType);
        return $result;
    }

    public function getFlowConnectors($flowId)
    {
        $result = (new Connector)->getFlowConnectors($flowId);
        return $result;
    }
}
