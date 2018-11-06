@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj menu</h2>
        <a class="btn-back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Powrót</a>
    </div>
        @include('layouts.form.form_template_table',['url'=>'/cms/menu/create','form'=>$form])

@endsection