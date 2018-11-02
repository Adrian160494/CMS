<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'projekty') {{'active'}} @endif"><a href="{{url()->route('projekty.index')}}">Projekty</a></li>
        <li class="tab @if(Session::get('active') == 'manage') {{'active'}} @endif"><a href="{{url()->route('projekty.manage')}}">Zarządzaj</a></li>
    </ul>
</div>