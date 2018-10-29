@extends('layouts.main')
@include('messages.messages')


@section('content')
    <div class="container-mine">
        <div class="background"></div>
        <nav>
            <div class="col-md-12 navigation-bar">
                <div class="col-md-9">
                    <div class="navigation navbar">
                        <ul class="navbar-nav nav">
                            <li><a href="#">Projekty</a> </li>
                            <li><a href="#">CMS</a> </li>
                            <li><a href="#">Ustawienia</a> </li>
                            <li><a href="#">Narzędzia</a> </li>
                            <li><a href="#">Panel</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="navigation navbar">
                        <ul class="navbar-nav nav">
                            <li><a href="#"><span>Zalogowano jako: {{Session::get('username')}}</span></a></li>
                            <li><a href="{{url()->route('logout') }}">Wyloguj</a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    @endsection