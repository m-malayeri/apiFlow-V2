@extends('layouts.inside')

@section('content')
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="invokeOutputs-tab" data-bs-toggle="tab" data-bs-target="#invokeOutputs" type="button" role="tab" aria-controls="invokeOutputs" aria-selected="false">Invoke Outputs</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="invokeOutputs" role="tabpanel" aria-labelledby="invokeOutputs-tab">
        @if (Session::has('message'))
        <div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
        @endif

        @if(count($invokeOutputs)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Invoke Id</th>
                    <th scope="col">Output Name</th>
                    <th scope="col">Save as Prop Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invokeOutputs as $invokeOutput)
                <tr>
                    <th scope="row">{{$invokeOutput->id}}</th>
                    <td>{{$invokeOutput->invoke_id}}</td>
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
    <form method="post" action="">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Invoke Output</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Invoke Id</span>
                    <input type="text" id="invoke_id" name="invoke_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Output Name</span>
                    <input type="text" id="output_name" name="output_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Save as Prop.</span>
                    <input type="text" id="save_as_prop_name" name="save_as_prop_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection