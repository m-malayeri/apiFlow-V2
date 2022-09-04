<?php

namespace App\Http\Controllers;

use App\Models\Flow;
use App\Models\InvokeInput;
use Illuminate\Http\Request;

class InvokeInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)
    {
        $invokeInputs = InvokeInput::where('flow_id', $flow->id)->get();
        return view('invokeInputs')->with(compact('flow', 'invokeInputs'));
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
            'input_name' => 'required',
            'input_type' => 'required'
        ]);

        $invokeInput = new InvokeInput;

        $invokeInput->flow_id = $request->input('flow_id');
        $invokeInput->invoke_id = $request->input('invoke_id');
        $invokeInput->input_name = $request->input('input_name');
        $invokeInput->input_type = $request->input('input_type');
        $invokeInput->literal_value = $request->input('literal_value');
        $invokeInput->api_input_name = $request->input('api_input_name');
        $invokeInput->created_at = now();
        $invokeInput->updated_at = now();

        $invokeInput->save();
        return redirect(url()->previous())->withMessage('Invoke input record inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function show(InvokeInput $invokeInput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function edit(InvokeInput $invokeInput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvokeInput $invokeInput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvokeInput  $invokeInput
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvokeInput $invokeInput)
    {
        $invokeInput->delete();
        return redirect(url()->previous())->withMessage('Invoke input record deleted successfully');
    }
}
