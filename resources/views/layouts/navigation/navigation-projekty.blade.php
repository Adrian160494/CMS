<div class="navigation-tabs">
    <ul>
            <li class="tab @if(Session::get('active') == 'projektyList') {{'active'}} @endif"><a href="{{url()->route('projekty.projekty')}}">Projekty</a></li>
                 <li class="tab @if(Session::get('active') == 'manage') {{'active'}} @endif"><a href="{{url()->route('projekty.manage')}}">Zarządzaj</a></li>
      </ul>
</div>