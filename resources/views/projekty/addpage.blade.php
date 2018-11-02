@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj stronę</h2>
        <a class="btn-back" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/projekty/manage/addPage/'.$id,'form'=>$form])

@endsection