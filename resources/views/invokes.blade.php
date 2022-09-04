@extends('layouts.inside')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/flows">Flows</a></li>
        <li class="breadcrumb-item active">Invokes</li>
    </ol>
</nav>
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="invokes-tab" data-bs-toggle="tab" data-bs-target="#invokes" type="button" role="tab" aria-controls="invokes" aria-selected="false">Invokes</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="invokes" role="tabpanel" aria-labelledby="invokes-tab">
        @if(count($invokes)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Node Id</th>
                    <th scope="col">URL</th>
                    <th scope="col">Method</th>
                    <th scope="col">Content Type</th>
                    <th scope="col">Auth Type</th>
                    <th scope="col">Req. Parent</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invokes as $invoke)
                <tr>
                    <th scope="row">{{$invoke->id}}</th>
                    <td>{{$invoke->flow_node_id}}</td>
                    <td>{{Str::limit($invoke->url, 30)}}</td>
                    <td>{{$invoke->method}}</td>
                    <td>{{$invoke->content_type}}</td>
                    <td>{{$invoke->auth_type}}</td>
                    <td>{{$invoke->req_parent_object}}</td>
                    <td class="my-icons">
                        <form id="delete-form" action="{{route('invokes.destroy',$invoke)}}" class="d-inline" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="fa fa-remove my-delete" onclick="return confirm('Are you sure?')"></button>
                        </form>
                    </td>
                </tr>
                @if(isset($invokeInputs[$invoke->id]))
                <tr>
                    <td colspan="6">
                        <table class="table mb-0 my-nested-table">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2"></th>
                                    <th scope="col">Input Name</th>
                                    <th scope="col">Input Type</th>
                                    <th scope="col">Literal Value</th>
                                    <th scope="col">API Input Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $invokeInputsArray = $invokeInputs->where('invoke_id', $invoke->id);
                                @endphp
                                @foreach($invokeInputsArray as $invokeInput)
                                <tr>
                                    <th scope="row"></th>
                                    <td>{{$invokeInput->input_name}}</td>
                                    <td>{{$invokeInput->input_type}}</td>
                                    <td>{{$invokeInput->literal_value}}</td>
                                    <td>{{$invokeInput->api_input_name}}</td>
                                </tr>
                                @endforeach
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
    <form method="post" action="{{route('flows.invokes.store', $flow)}}">
        @csrf
        <input type="hidden" class="form-control" id="flow_id" name="flow_id" value="{{$flow->id}}" required>
        <div class="card">
            <div class="card-header">New Invoke</div>
            <div class="card-body">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Flow Node Id</span>
                    <input type="text" id="flow_node_id" name="flow_node_id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">URL</span>
                    <input type="text" id="url" name="url" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Method</label>
                    <select id="method" name="method" class="form-select" id="inputGroupSelect01">
                        <option selected>POST</option>
                        <option>GET</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Content Type</label>
                    <select id="content_type" name="content_type" class="form-select" id="inputGroupSelect01">
                        <option selected>application/json</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <label class="input-group-text" for="inputGroupSelect01">Auth. type</label>
                    <select id="auth_type" name="auth_type" class="form-select" id="inputGroupSelect01">
                        <option selected>Basic</option>
                    </select>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">User</span>
                    <input type="text" id="user" name="user" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
                    <input type="password" id="password" name="password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-default">Req. Parent</span>
                    <input type="text" id="req_parent_object" name="req_parent_object" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection