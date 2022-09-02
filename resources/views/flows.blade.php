@extends('layouts.landing')

@section('content')
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="flows-tab" data-bs-toggle="tab" data-bs-target="#flows" type="button" role="tab" aria-controls="flows" aria-selected="true">Flows</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="flows" role="tabpanel" aria-labelledby="flows-tab">
        @if (Session::has('message'))
        <div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
        @endif

        @if(count($flows)>0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Flow Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Log Level</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flows as $flow)
                <tr>
                    <th scope="row">{{$flow->id}}</th>
                    <td>{{$flow->flow_name}}</td>
                    <td>{{$flow->status}}</td>
                    <td>{{$flow->log_level}}</td>
                    <td>{{$flow->created_at}}</td>
                    <td class="my-icons">
                        <a href="{{route('flows.nodes.index',$flow)}}" title="Configuration" class="d-inline"><i class="fa fa-search"></i></a>
                        <a href="{{route('flows.edit',$flow)}}" title="Edit" class="d-inline"><i class="fa fa-edit"></i></a>
                        <form action="{{route('flows.destroy',$flow)}}" class="d-inline" method="POST">
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
    <form method="post" action="{{ route('flows.store')}}">
        @csrf
        <div class="card">
            <div class="card-header">New Flow</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Flow Name</span>
                    <input type="text" id="flow_name" name="flow_name" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Log Level</label>
                    <select id="log_level" name="log_level" class="form-select" id="inputGroupSelect01">
                        <option selected>All</option>
                        <option value="Property">Property</option>
                        <option value="Session">Session</option>
                        <option value="None">None</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection