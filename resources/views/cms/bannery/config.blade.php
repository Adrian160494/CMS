@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-cms',array('back'=>'cms.bannery'))
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">
        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('cms.bannery.createElement',array('id_baneru'=>$id_baneru,'id_projektu'=>$id_projektu))}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($bannery)
            <table class="table table-bordered table-center">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Zdjęcie</td>
                    <td>Nazwa</td>
                    <td>Opis</td>
                    <td>Data dodania</td>
                    <td>Aktywnosc</td>
                    <td width="50">Edytuj</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($bannery as $p)
                    <tr>
                        <td>
                            {{$p->id}}
                        </td>
                        <td>
                            <img src="{{$p->sciezka_plik}}" width="100" />
                        </td>
                        <td>
                            {{$p->nazwa}}
                        </td>
                        <td>
                            {{$p->opis}}
                        </td>
                        <td>
                            {{$p->data_dodania}}
                        </td>
                        <td>
                            @if($p->is_active)
                                <a href="{{url()->route('cms.banneryactivity',array('id'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('cms.banneryactivity',array('id'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn-edit">Edytuj</a>
                        </td>
                        <td>
                            <a href="{{ url()->route('cms.bannerydelete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
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