@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-cms')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 text-right">
            @include('layouts.form.form_template_inline',array('url'=>'/cms/posts/changeProjekt','form'=>$form))
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">

        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('cms.posts.create')}}?id_projektu={{$id_projektu}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        @if($posts)
            <table class="table table-bordered table-center">
                <thead>
                <tr>
                    <td>Id</td>
                    <td>Tytuł</td>
                    <td>Treść</td>
                    <td>Kategoria</td>
                    <td>Autor</td>
                    <td>Data dodania</td>
                    <td>Aktywność</td>
                    <td width="50">Edytuj</td>
                    <td width="50">Usuń</td>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $p)
                    <tr>
                        <td>
                            {{$p->id}}
                        </td>
                        <td>
                            {{$p->title}}
                        </td>
                        <td>
                            {{$p->description}}
                        </td>
                        <td>
                            {{$p->category}}
                        </td>
                        <td>
                            {{$p->author}}
                        </td>
                        <td width="220">
                            {{$p->date}}
                        </td>
                        <td width="50">
                            @if($p->is_active)
                                <a href="{{url()->route('cms.posts.activity',array('id'=>$p->id))}}" class="btn-yes">Tak</a>
                            @else
                                <a href="{{url()->route('cms.posts.activity',array('id'=>$p->id))}}" class="btn-no">Nie</a>
                            @endif
                        </td>
                        <td width="50">
                            <a href="{{url()->route('cms.posts.edit',array('id'=>$p->id,'id_projektu'=>$id_projektu))}}" class="btn-edit">Edytuj</a>
                        </td>
                        <td width="50">
                            <a href="{{ url()->route('cms.posts.delete',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
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