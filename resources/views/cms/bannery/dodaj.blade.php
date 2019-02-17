@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj banner</h2>
        <a class="btn-back" href="{{url()->route('cms.bannery')}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/cms/bannery/create','form'=>$form])

@endsection