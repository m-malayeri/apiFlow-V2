@extends('layouts.landing')

@section('content')
<ul class="nav nav-tabs my-nav-tab" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="sessions-tab" data-bs-toggle="tab" data-bs-target="#sessions" type="button" role="tab" aria-controls="sessions" aria-selected="false">Sessions</button>
    </li>
</ul>
<div class="tab-content my-tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
        @if(count($sessions)>0)
        <table class="table table-striped table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Flow Name</th>
                    <th scope="col">Source IP</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                <tr>
                    <th scope="row">{{$session->id}}</th>
                    <td>{{$session->flow_name}}</td>
                    <td>{{$session->src_ip}}</td>
                    <td>{{$session->created_at}}</td>
                    <td>{{$session->updated_at}}</td>
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