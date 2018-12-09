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
            <a href="{{url()->route('config.pictures.create')}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($pictures)
            <table class="table table-hover table-bordered table-center">
                <thead>
                <tr>
                    <td width="50">Id</td>
                    <td>Szerokość</td>
                    <td>Wysokość</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($pictures as $p)
                    <tr>
                        <td>
                            {{$p->id}}
                        </td>
                        <td>
                            {{$p->width}}
                        </td>
                        <td>
                            {{$p->height}}
                        </td>
                        <td>
                            <a href="{{ url()->route('config.pictures.delete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
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