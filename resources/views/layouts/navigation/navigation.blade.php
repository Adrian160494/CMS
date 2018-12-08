<nav style="height: 100px;">
    <div class="col-md-12 navigation-bar">
        <div class="col-md-1">
            <img src="/img/logo.png" width="70"/>
        </div>
        <div class="col-md-7">
            <div class="navigation navbar  nav-main">
                <ul class="navbar-nav navv">
                    @if(resolve('checkPermission')->checkPermission('projekty',Session::get('account_type')))
                        <li @if(Session::get('activeMain') == 'projekty') class="active" @endif><a href="{{url()->route('projekty')}}">Projekty</a> </li>
                    @endif
                        @if(resolve('checkPermission')->checkPermission('cms',Session::get('account_type')))
                            <li @if(Session::get('activeMain') == 'menu') class="active" @endif><a href="{{url()->route('cms')}}">CMS</a> </li>
                        @endif
                        @if(resolve('checkPermission')->checkPermission('config',Session::get('account_type')))
                            <li @if(Session::get('activeMain') == 'ustawienia') class="active" @endif><a href="{{url()->route('config')}}">Ustawienia</a> </li>
                        @endif
                        @if(resolve('checkPermission')->checkPermission('panel.index',Session::get('account_type')))
                            <li @if(Session::get('activeMain') == 'panel') class="active" @endif><a href="{{url()->route('panel.index')}}">Panel</a> </li>
                        @endif
                        @if(resolve('checkPermission')->checkPermission('users.index',Session::get('account_type')))
                            <li @if(Session::get('activeMain') == 'users') class="active" @endif><a href="{{url()->route('users.index')}}">Użytkownicy</a> </li>
                        @endif
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="navigation navbar">
                <ul class="navbar-nav navv">
                    <li style="margin-right:20px;"><span>Zalogowano jako: {{Session::get('username')}}</span></li>
                    <li><a href="{{url()->route('logout') }}">Wyloguj</a> </li>
                </ul>
            </div>
        </div>
    </div>
</nav>