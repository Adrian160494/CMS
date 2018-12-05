@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-cms',array('back'=>'cms.bannery'))
    @include('layouts.navigation.navigation-nested',array("tab"=>"Konfiguracja"))
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
            <table class="table table-hover table-bordered table-center">
                <thead>
                <tr>
                    <td width="50">Id</td>
                    <td width="150">Zdjęcie</td>
                    <td>Nazwa</td>
                    <td>Opis</td>
                    <td width="220">Data dodania</td>
                    <td>Wymiary</td>
                    <td width="50">Aktywnosc</td>
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
                            @if($p->sciezka_plik)
                                @php
                                        $availableSizes = app()->make('ImageSizes')->getSizes($p->id_plik);
                                //dump($availableSizes);die;
                                $count=0;
                                        @endphp
                                @foreach($size as $s)
                                    @foreach($availableSizes as $a)
                                        @if($s->id == $a->id_size)
                                            @php
                                                $count++;
                                            @endphp
                                        @endif
                                    @endforeach
                                        @if($count > 0)
                                            <a href="#" class="btn-yes">{{$s->width}}/{{$s->height}}</a>
                                        @else
                                            <a href="{{url()->route('config.pictureresize',array('id'=>$p->id,'width'=>$s->width,'height'=>$s->height,'id_size'=>$s->id))}}" class="btn-no">{{$s->width}}/{{$s->height}}</a>
                                        @endif
                                    @php
                                    $count=0;
                                    @endphp
                                @endforeach
                                @else

                            @endif
                        </td>
                        <td>
                            @if($p->is_active)
                                <a href="{{url()->route('cms.bannery.changeElementActivity',array('id_baneru'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('cms.bannery.changeElementActivity',array('id_baneru'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                        </td>
                        <td>
                            <a href="" class="btn-edit">Edytuj</a>
                        </td>
                        <td>
                            <a href="{{ url()->route('cms.bannery.deleteElement',array('id_baneru'=>$p->id)) }}" class="btn-delete">Usuń</a>
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