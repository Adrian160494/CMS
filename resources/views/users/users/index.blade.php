@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-users')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">
        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('users.userscreate')}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($users)
            <table class="table table-hover table-bordered table-center">
                <thead>
                <tr>
                    <td width="50">Id</td>
                    <td>Imię</td>
                    <td>Email</td>
                    <td>Typ</td>
                    <td width="100">Uprawnienia</td>
                    <td width="50">Aktywowany</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $p)
                    <tr>
                        <td>
                            {{$p->id}}
                        </td>
                        <td>
                            {{$p->username}}
                        </td>
                        <td>
                            {{$p->email}}
                        </td>
                        <td>
                            {{$p->type}}
                        </td>
                        <td>
                            <a href="" class="btn btn-standard">Konfiguruj</a>
                        </td>
                        <td>
                            @if($p->is_active)
                                <span class="btn-yes">Tak</span>
                            @else
                                <span class="btn-no">Nie</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url()->route('config.picturesdelete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
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