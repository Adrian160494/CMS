<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'projekty') {{'active'}} @endif"><a href="{{url()->route('projekty.index')}}">Projekty</a></li>
        <li class="tab @if(Session::get('active') == 'manage') {{'active'}} @endif"><a href="#">Zarządzaj</a></li>
        <li class="tab @if(Session::get('active') == 'menu') {{'active'}} @endif"><a href="#">Menu</a></li>
        <li class="tab @if(Session::get('active') == 'banner') {{'active'}} @endif"><a href="#">Banery</a></li>
    </ul>
</div>