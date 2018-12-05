@extends('layouts.logged')
@section('main-section')
    @include('layouts.navigation.navigation-cms',array('back','cms.menu'))
    @include('layouts.navigation.navigation-nested',array("tab"=>"Konfiguracja"))
    <div class="container">
        <div class="col-md-12 menu-panel">
            <div class="col-md-12 sidebar-pages">
                <div class="row">
                    <div class="col-md-8">
                        <h2>{{$menu->nazwa}}</h2>
                    </div>
                    <div class="col-md-4 text-right" style="margin-top:20px; margin-bottom:10px;">
                        <a href="{{url()->route('cms.menu.addPosition',array('id'=>$id_menu))}}?id_projektu={{$id_projektu}}" class="btn-add add-menu">Dodaj</a>
                    </div>
                </div>
                <div class="menu-content">
                    @include('layouts.menu.standardMenu',array('menuPositions'=>$menuPositions,'id_projektu'=>$id_projektu))
                </div>
            </div>
        </div>
    </div>

@endsection