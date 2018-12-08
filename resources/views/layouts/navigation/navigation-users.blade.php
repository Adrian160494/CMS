<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'konta') {{'active'}} @endif"><a href="{{url()->route('users.index')}}">Użytkownicy</a></li>
        <li class="tab @if(Session::get('active') == 'permissions') {{'active'}} @endif"><a href="{{url()->route('users.permissions')}}">Uprawnienia</a></li>
        <div class="come-back">
        @if(isset($back))
            <a class="btn-back" href="{{url()->route($back)}}">Powrót</a>
            @endif
    </div>
</div>