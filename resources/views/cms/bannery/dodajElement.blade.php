@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj element baneru</h2>
        <a class="btn-back" href="{{url()->route('cms.bannery.config',array('id'=>$id_baneru,'id_projektu'=>$id_projektu))}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/cms/bannery/createElement/'.$id_baneru.'/'.$id_projektu,'form'=>$form,'formfile'=>1])

@endsection