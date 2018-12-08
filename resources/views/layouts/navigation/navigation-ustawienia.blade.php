<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'grafiki') {{'active'}} @endif"><a href="{{url()->route('config.pictures')}}">Grafiki</a></li>
        <li class="tab @if(Session::get('active') == 'kategorie') {{'active'}} @endif"><a href="{{url()->route('config.categories')}}">Kategorie</a></li>
    </ul>
        <div class="come-back">
        @if(isset($back))
            <a class="btn-back" href="{{url()->route($back)}}">Powrót</a>
            @endif
    </div>
</div>