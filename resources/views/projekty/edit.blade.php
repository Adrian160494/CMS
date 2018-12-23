@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Edytuj projekt</h2>
        <a class="btn-back" href="{{url()->route('projects.projects.list')}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/projekty/edit/'.$id,'form'=>$form])

@endsection