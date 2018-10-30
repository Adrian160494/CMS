@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj projekt</h2>
        <a class="btn-back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Powrót</a>
    </div>
    <div class="col-md-12">
        @include('layouts.form.form_template_table',['url'=>'/projekty/create','form'=>$form])
    </div>

@endsection