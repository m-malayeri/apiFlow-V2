@extends('layouts.inside')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class='fa fa-home'></i></a></li>
        <li class="breadcrumb-item"><a href="/flows">Flows</a></li>
        <li class="breadcrumb-item active">Nodes</li>
    </ol>
</nav>
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="nodes-tab" data-bs-toggle="tab" data-bs-target="#nodes" type="button" role="tab" aria-controls="nodes" aria-selected="true">Nodes</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="nodes" role="tabpanel" aria-labelledby="nodes-tab">
        @if(count($flowNodes)>0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Node Name</th>
                    <th scope="col">Node Type</th>
                    <th scope="col">Sub Type</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flowNodes as $flowNode)
                <tr>
                    <th scope="row">{{$flowNode->id}}</th>
                    <td>{{$flowNode->node_name}}</td>
                    <td>{{$flowNode->node_type}}</td>
                    <td>{{$flowNode->sub_type}}</td>
                    <td>{{$flowNode->created_at}}</td>
                    <td class="my-icons">
                        <form id="delete-form" action="{{route('nodes.destroy',$flowNode)}}" class="d-inline" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="fa fa-remove my-delete" onclick="return confirm('Are you sure?')"></button>
                        </form>
                    </td>
                </tr>
                @if(isset($connectors[$flowNode->id]))
                <tr>
                    <td colspan="3">
                        <table class="table mb-0 my-nested-table">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2"></th>
                                    <th scope="col">Target Type</th>
                                    <th scope="col">Target Node Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <th>{{$connectors[$flowNode->id]->target_type}}</th>
                                    <th>{{$connectors[$flowNode->id]->target_id}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                @endif
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
    <form method="post" action="{{route('flows.nodes.store', $flow)}}">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Node</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Node Name</span>
                    <input type="text" id="node_name" name="node_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Node Type</label>
                    <select id="node_type" name="node_type" class="form-select" id="inputGroupSelect01">
                        <option selected>Start</option>
                        <option>Action</option>
                        <option>Decision</option>
                        <option>End</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Sub Type</span>
                    <input type="text" id="sub_type" name="sub_type" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection