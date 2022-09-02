<?php

namespace App\Http\Controllers;

use App\Models\Flow;
use App\Models\FlowNode;
use App\Models\Connector;
use Illuminate\Http\Request;

class FlowNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)
    {
        $flowNodes = FlowNode::where('flow_id', $flow->id)->get();
        $connectors = Connector::where('flow_id', $flow->id)->get();
        return view('nodes')->with(compact('flow', 'flowNodes', 'connectors'));
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
        $flowNode = new FlowNode;

        $flowNode->flow_id = $request->input('flow_id');
        $flowNode->node_name = $request->input('node_name');
        $flowNode->node_type = $request->input('node_type');
        $flowNode->sub_type = $request->input('sub_type');
        $flowNode->created_at = now();
        $flowNode->updated_at = now();

        $flowNode->save();
        return redirect(url()->previous())->withMessage('Node record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function show(FlowNode $flowNode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function edit(FlowNode $flowNode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlowNode $flowNode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlowNode  $flowNode
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlowNode $node)
    {
        $node->delete();
        return redirect(url()->previous())->withMessage('Record deleted successfully');
    }

    public function getFlowNodes($flowId)
    {
        $result = (new FlowNode)->getFlowNodes($flowId);
        return $result;
    }

    public function getFirstNodeId($flowId)
    {
        $result = (new FlowNode)->getFirstNodeId($flowId);
        return $result;
    }

    public function getLastNodeId($flowId)
    {
        $result = (new FlowNode)->getLastNodeId($flowId);
        return $result;
    }
}
