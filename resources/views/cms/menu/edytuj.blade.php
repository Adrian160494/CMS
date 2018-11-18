@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Edytuj menu</h2>
        <a class="btn-back" href="{{url()->route('cms.menu')}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/cms/menu/edit/'.$id.'/'.$id_projektu,'form'=>$form])

@endsection