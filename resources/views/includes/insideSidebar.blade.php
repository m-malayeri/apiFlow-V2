<div class="list-group">
    <a href="{{url('flows')}}" class="list-group-item list-group-item-action" aria-current="true">Flows</a>
    <a href="{{route('flows.nodes.index',$flow)}}" class="list-group-item list-group-item-action {{ Request::is('*/nodes') ? 'active' : '' }}" aria-current="true"> Nodes</a>
    <a href="{{route('flows.invokes.index',$flow)}}" class="list-group-item list-group-item-action {{ Request::is('*/invokes') ? 'active' : '' }}" aria-current="true"> Invokes</a>
    <a href="{{route('flows.invokeInputs.index',$flow)}}" class="list-group-item list-group-item-action {{ Request::is('*/invokeInputs') ? 'active' : '' }}" aria-current="true"> Invoke Inputs</a>
    <a href="{{route('flows.invokeOutputs.index',$flow)}}" class="list-group-item list-group-item-action {{ Request::is('*/invokeOutputs') ? 'active' : '' }}" aria-current="true"> Invoke Outputs</a>
    <a href="{{route('flows.decisions.index',$flow)}}" class="list-group-item list-group-item-action {{ Request::is('*/decisions') ? 'active' : '' }}" aria-current="true"> Decisions</a>
    <a href="{{route('flows.connectors.index',$flow)}}" class="list-group-item list-group-item-action {{ Request::is('*/connectors') ? 'active' : '' }}" aria-current="true"> Connectors</a>
</div>