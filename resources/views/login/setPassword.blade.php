@include('messages.messages')
@extends('layouts.main')

@section('content')
    <div class="loginPage">
        <div class="container-mine">
            <div class="title-page">
                <h1>Ustawienie hasła</h1>
            </div>
            <div class="login-form">
                @include('layouts.form.form_template',['url'=>'/setPassword','form'=>$form])
            </div>
        </div>
    </div>
@endsection