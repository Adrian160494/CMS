@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-ustawienia',array('back'=>'config.galleries.list'))
    @include('layouts.navigation.navigation-nested',array("tab"=>"Konfiguracja"))
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">
        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('config.galleries.createElement',array('id'=>$id))}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($elements)
            @foreach($elements as $e)
            <div class="col-md-3 gallery-element">
                <div class="element-content">
                    <div class="img">
                        <img src="{{$e->sciezka_plik}}" alt="" />
                    </div>
                    <div class="gallery-picture-desc">
                        <h4>
                            Tytuł: {{$e->name}}
                        </h4>
                        <p>Opis: {{$e->description}}</p>
                        <p>Autor: {{$e->author}}</p>
                    </div>
                    <div class="config-buttons">
                      <div class="col-md-12">
                          <div class="col-md-4">
                              <a href="{{url()->route('config.galleries.editElement',array('id'=>$e->id))}}" class="btn-standard">Opis</a>
                          </div>
                          <div class="col-md-4">
                              <a href="{{url()->route('config.galleries.editElement',array('id'=>$e->id))}}" class="btn-edit">Edytuj</a>

                          </div>
                          <div class="col-md-4">
                              <a href="{{ url()->route('config.galleries.deleteElement',array('id'=>$e->id)) }}" class="btn-delete">Usuń</a>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
                @endforeach
        @else
            <h2 style="text-align:center; font-style: italic; color: #999;">Brak wyników</h2>
        @endif
    </div>
@endsection