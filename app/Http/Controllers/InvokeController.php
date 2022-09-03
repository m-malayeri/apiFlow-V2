<?php

namespace App\Http\Controllers;

use App\Models\Flow;
use App\Models\Invoke;
use App\Models\InvokeInput;
use Illuminate\Http\Request;

class InvokeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)
    {
        $invokes = Invoke::where('flow_id', $flow->id)->get();
        $invokeInputs = InvokeInput::where('flow_id', $flow->id)->get();
        return view('invokes')->with(compact('flow', 'invokes', 'invokeInputs'));
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
            'flow_node_id' => 'required',
            'url' => 'required',
            'method' => 'required',
            'content_type' => 'required',
            'auth_type' => 'required'
        ]);

        $invoke = new Invoke;

        $invoke->flow_id = $request->input('flow_id');
        $invoke->flow_node_id = $request->input('flow_node_id');
        $invoke->url = $request->input('url');
        $invoke->method = $request->input('method');
        $invoke->content_type = $request->input('content_type');
        $invoke->auth_type = $request->input('auth_type');
        $invoke->user = $request->input('user');
        $invoke->password = $request->input('password');
        $invoke->req_parent_object = $request->input('req_parent_object');
        $invoke->created_at = now();
        $invoke->updated_at = now();

        $invoke->save();
        return redirect(url()->previous())->withMessage('Invoke record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function show(Invoke $invoke)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoke $invoke)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoke $invoke)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoke  $invoke
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoke $invoke)
    {
        $invoke->delete();
        return redirect(url()->previous())->withMessage('Invoke record deleted successfully');
    }

    public function getInvokeDetails($flowId, $flowNodeId)
    {
        $result = (new Invoke)->getInvokeDetails($flowId, $flowNodeId);
        return $result;
    }
}
