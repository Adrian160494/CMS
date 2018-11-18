@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Dodaj pozycję menu</h2>
        <a class="btn-back" href="{{url()->route('cms.menu.config',array('id'=>$id_menu))}}?id_projektu={{$id_projektu}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/cms/menu/addPosition/'.$id_menu.'?id_projektu='.$id_projektu,'form'=>$form])

@endsection