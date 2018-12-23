@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Edytuj pozycje menu</h2>
        <a class="btn-back" href="{{url()->route('cms.menu.config',array('id'=>$id_menu))}}?id_projektu={{$id_projektu}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_table',['url'=>'/cms/menu/editPosition/'.$id.'?id_projektu='.$id_projektu.'&id_menu='.$id_menu,'form'=>$form])

@endsection