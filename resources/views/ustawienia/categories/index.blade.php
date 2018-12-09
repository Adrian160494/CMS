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
            <a href="{{url()->route('config.categories.create')}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($categories)
            <table class="table table-bordered table-hover  table-center">
                <thead>
                <tr>
                    <td width="50">Id</td>
                    <td>Kategoria</td>
                    <td width="50">Aktywność</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $p)
                    <tr>
                        <td width="50">
                            {{$p->id}}
                        </td>
                        <td>
                            {{$p->name}}
                        </td>
                        <td>
                            @if($p->is_active)
                                <a href="{{url()->route('config.categories.Activity',array('id'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('config.categories.Activity',array('id'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url()->route('config.categories.delete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
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