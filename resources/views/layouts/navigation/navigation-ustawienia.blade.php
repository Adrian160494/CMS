<div class="navigation-tabs">
    <ul>
        <li class="tab @if(Session::get('active') == 'grafiki') {{'active'}} @endif"><a href="{{url()->route('config.pictures.list')}}">Grafiki</a></li>
        <li class="tab @if(Session::get('active') == 'kategorie') {{'active'}} @endif"><a href="{{url()->route('config.categories.list')}}">Kategorie</a></li>
        <li class="tab @if(Session::get('active') == 'galerie') {{'active'}} @endif"><a href="{{url()->route('config.galleries.list')}}">Galerie</a></li>
    </ul>
        <div class="come-back">
        @if(isset($back))
            <a class="btn-back" href="{{url()->route($back)}}">Powrót</a>
            @endif
    </div>
</div>