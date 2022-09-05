@extends('layouts.inside')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class='fa fa-home'></i></a></li>
        <li class="breadcrumb-item"><a href="/flows">Flows</a></li>
        <li class="breadcrumb-item active">Connectors</li>
    </ol>
</nav>
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="connectors-tab" data-bs-toggle="tab" data-bs-target="#connectors" type="button" role="tab" aria-controls="connectors" aria-selected="false">Connectors</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="connectors" role="tabpanel" aria-labelledby="connectors-tab">
        @if(count($connectors)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Source Type</th>
                    <th scope="col">Source Node Name</th>
                    <th scope="col">Target Type</th>
                    <th scope="col">Target Node Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($connectors as $connector)
                <tr>
                    @php $sourceNode = $flowNodes->where('id', $connector->src_id)->first(); @endphp
                    <th scope="row">{{$connector->id}}</th>
                    <td>{{$connector->src_type}}</td>
                    <td>{{$sourceNode->node_name}}</td>
                    <td>{{$connector->target_type}}</td>
                    @php $targetNode = $flowNodes->where('id', $connector->target_id)->first(); @endphp
                    <td>{{$targetNode->node_name}}</td>
                    <td class="my-icons">
                        <form id="delete-form" action="{{route('connectors.destroy',$connector)}}" class="d-inline" method="POST">
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
    <form method="post" action="{{route('flows.connectors.store', $flow)}}">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Connector</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Source Type</label>
                    <select id="src_type" name="src_type" class="form-select" id="inputGroupSelect01">
                        <option selected>Start</option>
                        <option>Invoke</option>
                        <option>Decision</option>
                        <option>End</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Node Name</label>
                    <select id="src_id" name="src_id" class="form-select" id="inputGroupSelect01">
                        @foreach($flowNodes as $flowNode)
                        <option value="{{$flowNode->id}}">{{$flowNode->node_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Target Type</label>
                    <select id="target_type" name="target_type" class="form-select" id="inputGroupSelect01">
                        <option selected>Start</option>
                        <option>Invoke</option>
                        <option>Decision</option>
                        <option>End</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Node Name</label>
                    <select id="target_id" name="target_id" class="form-select" id="inputGroupSelect01">
                        @foreach($flowNodes as $flowNode)
                        <option value="{{$flowNode->id}}">{{$flowNode->node_name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection