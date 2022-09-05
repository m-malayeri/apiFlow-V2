@extends('layouts.inside')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class='fa fa-home'></i></a></li>
        <li class="breadcrumb-item"><a href="/flows">Flows</a></li>
        <li class="breadcrumb-item active">Decisions</li>
    </ol>
</nav>
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="decisions-tab" data-bs-toggle="tab" data-bs-target="#decisions" type="button" role="tab" aria-controls="decisions" aria-selected="false">Decisions</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="decisions" role="tabpanel" aria-labelledby="decisions-tab">
        @if(count($decisions)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Node Name</th>
                    <th scope="col">Property Name</th>
                    <th scope="col">Decision Type</th>
                    <th scope="col">Property Value</th>
                    <th scope="col">Next Node Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($decisions as $decision)
                <tr>
                    @php $decisionNode = $flowNodes->where('id', $decision->flow_node_id)->first(); @endphp
                    <th scope="row">{{$decision->id}}</th>
                    <td>{{$decisionNode->node_name}}</td>
                    <td>{{$decision->prop_name}}</td>
                    <td>{{$decision->decision_type}}</td>
                    <td>{{$decision->prop_value}}</td>
                    @php $nextNode = $flowNodes->where('id', $decision->next_node_id)->first(); @endphp
                    <td>{{$nextNode->node_name}}</td>
                    <td class="my-icons">
                        <form id="delete-form" action="{{route('decisions.destroy',$decision)}}" class="d-inline" method="POST">
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
    <form method="post" action="{{route('flows.decisions.store', $flow)}}">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Decision</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Node Name</label>
                    <select id="flow_node_id" name="flow_node_id" class="form-select" id="inputGroupSelect01">
                        @foreach($decisionNodes as $decisionNode)
                        <option value="{{$decisionNode->id}}">{{$decisionNode->node_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Property Name</span>
                    <input type="text" id="prop_name" name="prop_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Decision Type</label>
                    <select id="decision_type" name="decision_type" class="form-select" id="inputGroupSelect01" required>
                        <option selected>Equal</option>
                        <option>Not Equal</option>
                        <option>Greater Than</option>
                        <option>Less Than</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Property Value</span>
                    <input type="text" id="prop_value" name="prop_value" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Node Name</label>
                    <select id="next_node_id" name="next_node_id" class="form-select" id="inputGroupSelect01">
                        @foreach($nextNodes as $nextNode)
                        <option value="{{$nextNode->id}}">{{$nextNode->node_name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection