<?php

namespace App\Http\Controllers;

use App\Models\Flow;
use App\Models\Decision;
use Illuminate\Http\Request;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)
    {
        $decisions = Decision::where('flow_id', $flow->id)->get();
        return view('decisions')->with(compact('flow', 'decisions'));
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
        $decision = new Decision;

        $decision->flow_id = $request->input('flow_id');
        $decision->flow_node_id = $request->input('flow_node_id');
        $decision->prop_name = $request->input('prop_name');
        $decision->decision_type = $request->input('decision_type');
        $decision->prop_value = $request->input('prop_value');
        $decision->next_node_id = $request->input('next_node_id');
        $decision->created_at = now();
        $decision->updated_at = now();

        $decision->save();
        return redirect(url()->previous())->withMessage('Decision record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function show(Decision $decision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function edit(Decision $decision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Decision $decision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Decision  $decision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decision $decision)
    {
        $decision->delete();
        return redirect(url()->previous())->withMessage('Decision record deleted successfully');
    }

    public function getDecisionLines($flowNodeId)
    {
        $result = (new Decision)->getDecisionLines($flowNodeId);
        return $result;
    }

    public function getDecisionDetails($flowNodeId)
    {
        $result = (new Decision)->getDecisionDetails($flowNodeId);
        return $result;
    }

    public function getFlowDecisions($flowId)
    {
        $result = (new Decision)->getFlowDecisions($flowId);
        return $result;
    }
}
