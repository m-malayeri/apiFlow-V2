<div class="list-group">
    <a href="{{url('/flows')}}" class="list-group-item list-group-item-action {{ Request::is('flows') ? 'active' : '' }}" aria-current="true">Flows</a>
    <a href="{{url('/sessions')}}" class="list-group-item list-group-item-action {{ Request::is('sessions') ? 'active' : '' }}" aria-current="true">Sessions</a>
    <a href="{{url('/logs')}}" class="list-group-item list-group-item-action {{ Request::is('logs') ? 'active' : '' }}" aria-current="true">Inbound Logs</a>
    <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Help</a>
</div>