@extends('layouts.inside')

@section('content')
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="invokeInputs-tab" data-bs-toggle="tab" data-bs-target="#invokeInputs" type="button" role="tab" aria-controls="invokeInputs" aria-selected="false">Invoke Inputs</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="invokeInputs" role="tabpanel" aria-labelledby="invokeInputs-tab">
        @if(count($invokeInputs)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Invoke Id</th>
                    <th scope="col">Input Name</th>
                    <th scope="col">Input Type</th>
                    <th scope="col">Literal Value</th>
                    <th scope="col">API Input Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invokeInputs as $invokeInput)
                <tr>
                    <th scope="row">{{$invokeInput->id}}</th>
                    <td>{{$invokeInput->invoke_id}}</td>
                    <td>{{$invokeInput->input_name}}</td>
                    <td>{{$invokeInput->input_type}}</td>
                    <td>{{$invokeInput->literal_value}}</td>
                    <td>{{$invokeInput->api_input_name}}</td>
                    <td class="my-icons">
                        <form id="delete-form" action="{{route('invokeInputs.destroy',$invokeInput)}}" class="d-inline" method="POST">
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
    <form method="post" action="{{route('flows.invokeInputs.store', $flow)}}">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Invoke Input</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Invoke Id</span>
                    <input type="text" id="invoke_id" name="invoke_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Input Name</span>
                    <input type="text" id="input_name" name="input_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Input Type</label>
                    <select id="input_type" name="input_type" class="form-select" id="inputGroupSelect01">
                        <option selected>User</option>
                        <option>Literal</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Literal Value</span>
                    <input type="text" id="literal_value" name="literal_value" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">API Input Name</span>
                    <input type="text" id="api_input_name" name="api_input_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection