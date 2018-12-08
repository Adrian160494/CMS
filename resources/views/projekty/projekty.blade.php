@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-projekty')

    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">

        </div>
        <div class="col-md-4 addings">
            @if(resolve('checkPermission')->checkPermission('projekty.create',Session::get('account_type')))
                <a href="{{url()->route('projekty.create')}}" class="btn-add">Dodaj</a>
            @endif
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        <table class="table table-hover table-bordered table-center">
            <thead>
            <tr>
                <td width="50">Id</td>
                <td>Nazwa</td>
                <td>Url</td>
                <td width="50">Aktywna</td>
                <td width="100">Konfiguracja</td>
                <td width="50">Edytuj</td>
                <td width="50">Usuń</td>
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
                        {{$p->url}} <a href="http://{{$p->url}}" class="btn btn-standard">Podgląd</a>
                    </td>
                    <td>
                        @if($p->is_active)
                            <span class="btn-yes">Tak</span>
                        @else
                            <span class="btn-no">Nie</span>
                        @endif
                    </td>
                    <td>
                        @if(resolve('checkPermission')->checkPermission('projekty.konfiguracja',Session::get('account_type')))
                            <a href="{{url()->route('projekty.konfiguracja',array('id_projekty'=>$p->id)) }}" class="btn-standard">Konfiguracja</a>
                        @endif
                    </td>
                    <td>
                        @if(resolve('checkPermission')->checkPermission('projekty.create',Session::get('account_type')))
                            <a href="#" class="btn-edit">Edytuj</a>
                        @endif

                    </td>
                    <td>
                        @if(resolve('checkPermission')->checkPermission('projekty.delete',Session::get('account_type')))
                            <a href="{{ url()->route('projekty.delete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection