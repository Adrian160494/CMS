@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj galerie zdjęć</h2>
        <a class="btn-back" href="{{url()->route('config.galleries.list')}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/configuration/gallery/create','form'=>$form])

@endsection