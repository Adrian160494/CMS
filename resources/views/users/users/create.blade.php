@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Stwórz nowe konto</h2>
        <a class="btn-back" href="/users">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/users/create','form'=>$form])

@endsection