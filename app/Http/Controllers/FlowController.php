<?php

namespace App\Http\Controllers;

use App\Models\Flow;

use App\Http\Controllers\FlowNodeController;

use Illuminate\Http\Request;

class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flows = Flow::all();
        return view('flows')->with(compact('flows'));
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
        $request->validate([
            'flow_name' => 'required|unique:flows|max:128',
            'log_level' => 'required',
        ]);

        $flow = new Flow;

        $flow->flow_name = $request->input('flow_name');
        $flow->status = "Enabled";
        $flow->log_level = $request->input('log_level');
        $flow->created_at = now();
        $flow->updated_at = now();

        $flow->save();

        return redirect()->route('flows.index')->withMessage('Record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function show(Flow $flow)
    {
        $flowNodes = (new FlowNodeController)->getFlowNodes($flow->id);
        $invokes = (new InvokeController)->getFlowInvokes($flow->id);
        $decisions = (new DecisionController)->getFlowDecisions($flow->id);
        $connectors = (new ConnectorController)->getFlowConnectors($flow->id);
        $invokeInputs = (new InvokeInputController)->getFlowInvokeInputs($flow->id);
        $invokeOutputs = (new InvokeOutputController)->getFlowInvokeOutputs($flow->id);

        return view('flowNodes')->with(compact('flow', 'flowNodes', 'invokes', 'decisions', 'connectors', 'invokeInputs', 'invokeOutputs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function edit(Flow $flow)
    {
        return view('flows')->with(compact('flow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flow $flow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flow  $flow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flow $flow)
    {
        $flow->delete();
        return redirect()->route('flows.index')->withMessage('Record deleted successfully');
    }

    public function getFlowDetailsByName($flowName)
    {
        $result = (new Flow)->getFlowDetailsByName($flowName);
        return $result;
    }
}
