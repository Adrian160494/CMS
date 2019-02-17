@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj zdjęcie</h2>
        <a class="btn-back" href="{{url()->route('config.galleries.config',array('id'=>$id_gallery))}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/configuration/gallery/createElement/'.$id_gallery,'form'=>$form,'formfile'=>1])

@endsection