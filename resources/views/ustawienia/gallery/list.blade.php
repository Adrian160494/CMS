@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-ustawienia')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">
        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('config.galleries.create')}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($galleries)
            <table class="table table-bordered table-hover  table-center">
                <thead>
                <tr>
                    <td width="50">Id</td>
                    <td>Nazwa</td>
                    <td width="50">Aktywność</td>
                    <td width="50">Konfiguruj</td>
                    <td width="50">Edytuj</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($galleries as $p)
                    <tr>
                        <td width="50">
                            {{$p->id}}
                        </td>
                        <td>
                            {{$p->name}}
                        </td>
                        <td>
                            @if($p->is_active)
                                <a href="{{url()->route('config.galleries.Activity',array('id'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('config.galleries.Activity',array('id'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{url()->route('config.galleries.config',array('id'=>$p->id))}}" class="btn-standard">Konfiguruj</a>
                        </td>
                        <td>
                            <a href="{{url()->route('config.galleries.edit',array('id'=>$p->id))}}" class="btn-edit">Edytuj</a>
                        </td>
                        <td>
                            <a href="{{ url()->route('config.galleries.delete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
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