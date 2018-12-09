@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-cms')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 text-right">
            @include('layouts.form.form_template_inline',array('url'=>'/cms/changeProjekt','form'=>$form))
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">

        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('cms.menu.create')}}?id_projektu={{$id_projektu}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($menu)
            <table class="table table-hover table-bordered table-center">
                <thead>
                <tr>
                    <td width="50">Id</td>
                    <td>Nazwa</td>
                    <td>Submenu</td>
                    <td width="50">Aktywny</td>
                    <td width="50">Edytuj</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($menu as $p)
                    <tr>
                        <td>
                            {{$p->id}}
                        </td>
                        <td>
                            {{$p->nazwa}}
                        </td>
                        <td>
                            @if($p->czy_submenu)
                                <a href="{{url()->route('cms.menu.submenu',array('id'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('cms.menu.submenu',array('id'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                            <a href="{{url()->route('cms.menu.config',array('id'=>$p->id))}}?id_projektu={{$p->id_projektu}}" class="btn-standard">Konfiguruj</a>
                        </td>
                        <td>
                            @if($p->is_active)
                                <a href="{{url()->route('cms.menu.activity',array('id'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('cms.menu.activity',array('id'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{url()->route('cms.menu.edit',array('id'=>$p->id,'id_projektu'=>$p->id_projektu))}}" class="btn-edit">Edytuj</a>
                        </td>
                        <td>
                            <a href="{{ url()->route('cms.menu.delete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            <h2 style="text-align:center; font-style: italic; color: #999;">Brak wyników</h2>
        @endif
    </div>
@endsection