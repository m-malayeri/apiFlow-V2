@extends('layouts.inside')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class='fa fa-home'></i></a></li>
        <li class="breadcrumb-item"><a href="/flows">Flows</a></li>
        <li class="breadcrumb-item active">Invoke Outputs</li>
    </ol>
</nav>
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="invokeOutputs-tab" data-bs-toggle="tab" data-bs-target="#invokeOutputs" type="button" role="tab" aria-controls="invokeOutputs" aria-selected="false">Invoke Outputs</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="invokeOutputs" role="tabpanel" aria-labelledby="invokeOutputs-tab">
        @if(count($invokeOutputs)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Node Name</th>
                    <th scope="col">Output Name</th>
                    <th scope="col">Save as Prop Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invokeOutputs as $invokeOutput)
                <tr>
                    @php
                    $invoke = $invokes->where('id', $invokeOutput->invoke_id)->first();
                    $invokeNode = $invokeNodes->where('id', $invoke->flow_node_id)->first();
                    @endphp

                    <th scope="row">{{$invokeOutput->id}}</th>
                    <td>{{$invokeNode->node_name}}</td>
                    <td>{{$invokeOutput->output_name}}</td>
                    <td>{{$invokeOutput->save_as_prop_name}}</td>
                    <td class="my-icons">
                        <form id="delete-form" action="{{route('invokeOutputs.destroy',$invokeOutput)}}" class="d-inline" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="fa fa-remove my-delete" onclick="return confirm('Are you sure?')"></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-warning" role="alert">No records</div>
        @endif
    </div>
</div>
@endsection

@section('extraSidebar')
<div class="my-new-record">
    <form method="post" action="{{route('flows.invokeOutputs.store', $flow)}}">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Invoke Output</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Node Name</label>
                    <select id="invoke_id" name="invoke_id" class="form-select" id="inputGroupSelect01">
                        @foreach($invokeNodes as $invokeNode)
                        <option value="{{$invokeNode->flow_node_id}}">{{$invokeNode->node_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Output Name</span>
                    <input type="text" id="output_name" name="output_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Save as Prop.</span>
                    <input type="text" id="save_as_prop_name" name="save_as_prop_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection