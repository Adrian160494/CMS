@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-projekty')

    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">

        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('projekty.create')}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Id</td>
                <td>Nazwa</td>
                <td>Url</td>
                <td>Aktywna</td>
                <td>Konfiguracja</td>
                <td>Zarządzaj</td>
                <td width="50">Edytuj</td>
            </tr>
            </thead>
            <tbody>
            @foreach($projekty as $p)
                <tr>
                    <td>
                        {{$p->id}}
                    </td>
                    <td>
                        {{$p->nazwa}}
                    </td>
                    <td>
                        {{$p->url}}
                    </td>
                    <td>
                        @if($p->is_active)
                            <span class="btn-yes">Tak</span>
                        @else
                            <span class="btn-no">Nie</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endsection