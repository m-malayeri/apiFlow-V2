@extends('layouts.inside')

@section('content')
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="decisions-tab" data-bs-toggle="tab" data-bs-target="#decisions" type="button" role="tab" aria-controls="decisions" aria-selected="false">Decisions</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="decisions" role="tabpanel" aria-labelledby="decisions-tab">
        @if (Session::has('message'))
        <div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
        @endif

        @if(count($decisions)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Node Id</th>
                    <th scope="col">Property Name</th>
                    <th scope="col">Decision Type</th>
                    <th scope="col">Property Value</th>
                    <th scope="col">Next Node Id</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($decisions as $decision)
                <tr>
                    <th scope="row">{{$decision->id}}</th>
                    <td>{{$decision->flow_node_id}}</td>
                    <td>{{$decision->prop_name}}</td>
                    <td>{{$decision->decision_type}}</td>
                    <td>{{$decision->prop_value}}</td>
                    <td>{{$decision->next_node_id}}</td>
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
    <form method="post" action="">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Decision</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Flow Node Id</span>
                    <input type="text" id="flow_node_id" name="flow_node_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Property Name</span>
                    <input type="text" id="prop_name" name="prop_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Decision Typ</label>
                    <select id="decision_type" name="decision_type" class="form-select" id="inputGroupSelect01">
                        <option selected>Equal</option>
                        <option>Not Equal</option>
                        <option>Greater Than</option>
                        <option>Less Than</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Property Value</span>
                    <input type="text" id="prop_value" name="prop_value" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Next Node Id</span>
                    <input type="text" id="next_node_id" name="next_node_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection