<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'menu') {{'active'}} @endif"><a href="{{url()->route('cms.menu')}}">Menu</a></li>
        <li class="tab @if(Session::get('active') == 'banner') {{'active'}} @endif"><a href="{{url()->route('cms.bannery')}}">Banery</a></li>
        <li class="tab @if(Session::get('active') == 'posts') {{'active'}} @endif"><a href="{{url()->route('cms.posts')}}">Wpisy</a></li>
        <li class="tab @if(Session::get('active') == 'news') {{'active'}} @endif"><a href="#">Wydarzenia</a></li>
    </ul>
    <div class="come-back">
        @if(isset($back))
            <a class="btn-back" href="{{url()->route($back)}}">Powrót</a>
            @endif
    </div>
</div>