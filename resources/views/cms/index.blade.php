@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-cms')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 text-right">
            @include('layouts.form.form_template_inline',array('url'=>'/cms/changeProjekt','form'=>$form))
        </div>
    </div>
    <div class="col-md-12 text-right">
        <div class="col-md-8 addings">

        </div>
        <div class="col-md-4 addings">
            <a href="{{url()->route('cms.menucreate')}}" class="btn-add">Dodaj</a>
        </div>
    </div>
    <div class="col-md-12 table-wrap">
        <table class="table table-bordered table-center">
            <thead>
            <tr>
                <td>Id</td>
                <td>Nazwa</td>
                <td>Ilośc pozycji</td>
                <td>Submenu</td>
                <td>Aktywny</td>
                <td width="50">Edytuj</td>
                <td width="50">Usuń</td>
            </tr>
            </thead>
            <tbody>
            @foreach($menu as $p)
                <tr>
                    <td>
                        {{$p->id}}
                    </td>
                    <td>
                        {{$p->nazwa}}
                    </td>
                    <td>

                    </td>
                    <td>
                        @if($p->czy_submenu)
                            <span class="btn-yes">Tak</span>
                        @else
                            <span class="btn-no">Nie</span>
                        @endif

                    </td>
                    <td>
                        @if($p->is_active)
                            <span class="btn-yes">Tak</span>
                        @else
                            <span class="btn-no">Nie</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn-edit">Edytuj</a>
                    </td>
                    <td>
                        <a href="{{ url()->route('projekty_destroy',array('id'=>$p->id)) }}" class="btn-delete">Usuń</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection