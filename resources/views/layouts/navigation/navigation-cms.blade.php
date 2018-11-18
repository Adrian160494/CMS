<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'menu') {{'active'}} @endif"><a href="{{url()->route('cms.menu')}}">Menu</a></li>
        <li class="tab @if(Session::get('active') == 'banner') {{'active'}} @endif"><a href="#">Banery</a></li>
        <li class="tab @if(Session::get('active') == 'info') {{'active'}} @endif"><a href="#">Aktualności</a></li>
        <li class="tab @if(Session::get('active') == 'news') {{'active'}} @endif"><a href="#">Wydarzenia</a></li>
    </ul>
</div>