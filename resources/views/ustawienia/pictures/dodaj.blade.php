@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj rozmiar</h2>
        <a class="btn-back" href="{{url()->route('config.pictures.list')}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/configuration/pictures/create','form'=>$form])

@endsection