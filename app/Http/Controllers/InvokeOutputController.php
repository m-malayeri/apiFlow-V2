<?php

namespace App\Http\Controllers;

use App\Models\Flow;
use App\Models\InvokeOutput;
use Illuminate\Http\Request;

class InvokeOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)
    {
        $invokeOutputs = InvokeOutput::where('flow_id', $flow->id)->get();
        return view('invokeOutputs')->with(compact('flow', 'invokeOutputs'));
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
            'invoke_id' => 'required',
            'output_name' => 'required',
            'save_as_prop_name' => 'required'
        ]);

        $invokeOutput = new InvokeOutput;

        $invokeOutput->flow_id = $request->input('flow_id');
        $invokeOutput->invoke_id = $request->input('invoke_id');
        $invokeOutput->output_name = $request->input('output_name');
        $invokeOutput->save_as_prop_name = $request->input('save_as_prop_name');
        $invokeOutput->created_at = now();
        $invokeOutput->updated_at = now();

        $invokeOutput->save();
        return redirect(url()->previous())->withMessage('Invoke output record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function show(InvokeOutput $invokeOutput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function edit(InvokeOutput $invokeOutput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvokeOutput $invokeOutput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvokeOutput  $invokeOutput
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvokeOutput $invokeOutput)
    {
        $invokeOutput->delete();
        return redirect(url()->previous())->withMessage('Invoke output record deleted successfully');
    }
}
