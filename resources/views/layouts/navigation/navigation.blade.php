<nav style="height: 100px;">
    <div class="col-md-12 navigation-bar">
        <div class="col-md-8">
            <div class="navigation navbar">
                <ul class="navbar-nav navv">
                    <li><a href="{{url()->route('projekty.index')}}">Projekty</a> </li>
                    <li><a href="#">CMS</a> </li>
                    <li><a href="#">Ustawienia</a> </li>
                    <li><a href="#">Narzędzia</a> </li>
                    <li><a href="#">Panel</a> </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="navigation navbar">
                <ul class="navbar-nav navv">
                    <li><span>Zalogowano jako: {{Session::get('username')}}</span></li>
                    <li><a href="{{url()->route('logout') }}">Wyloguj</a> </li>
                </ul>
            </div>
        </div>
    </div>
</nav>