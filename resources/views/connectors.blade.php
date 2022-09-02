@extends('layouts.inside')

@section('content')
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="connectors-tab" data-bs-toggle="tab" data-bs-target="#connectors" type="button" role="tab" aria-controls="connectors" aria-selected="false">Connectors</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="connectors" role="tabpanel" aria-labelledby="connectors-tab">
        @if (Session::has('message'))
        <div class="alert alert-success well-sm" role="alert">{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger well-sm" role="alert">{{ Session::get('error') }}</div>
        @endif

        @if(count($connectors)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Source Type</th>
                    <th scope="col">Source Node Id</th>
                    <th scope="col">Target Type</th>
                    <th scope="col">Target Node Id</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($connectors as $connector)
                <tr>
                    <th scope="row">{{$connector->id}}</th>
                    <td>{{$connector->src_type}}</td>
                    <td>{{$connector->src_id}}</td>
                    <td>{{$connector->target_type}}</td>
                    <td>{{$connector->target_id}}</td>
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
    <form method="post" action="">
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
                    <span class="input-group-text" id="inputGroup-sizing-default">Source Node Id</span>
                    <input type="text" id="src_id" name="src_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
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
                    <span class="input-group-text" id="inputGroup-sizing-default">Target Node Id</span>
                    <input type="text" id="target_id" name="target_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection