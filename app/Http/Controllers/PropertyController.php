<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($invokeResults, $invokeOutputs, $sessionId, $flowId)
    {
        foreach (json_decode($invokeResults) as $propName => $propValue) {
            foreach ($invokeOutputs as $invokeOutput) {
                if ($invokeOutput->output_name == $propName) {

                    $array = array(
                        'flow_id' => $flowId,
                        'session_id' => $sessionId,
                        'property_name' => $invokeOutput->save_as_prop_name,
                        'property_value' => $propValue,
                        'created_at' => now(),
                        'updated_at' => now()
                    );

                    $result = Property::where(['flow_id' => $flowId, 'session_id' => $sessionId, 'property_name' => $invokeOutput->save_as_prop_name])->first();
                    if ($result === null) {
                        Property::insert($array);
                    } else {
                        Property::where('id', $result->id)->update(['property_value' => $propValue]);
                    }
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Property::where('session_id', $id)->delete();
    }

    public function getPropertyDetails($flowId, $sessionId, $propertyName)
    {
        $result = (new Property)->getPropertyDetails($flowId, $sessionId, $propertyName);
        return $result;
    }
}
