@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-projekty')
    @include('layouts.navigation.navigation-nested',array("tab"=>"Konfiguracja"))

    <div class="col-md-12">
        <div class="col-md-6">
            <div class="col-md-12 heading-text">
                <h2>Konfiguracja projektu</h2>
            </div>
            <table class="table table-hover  table-bordered">
                <?php //dump($konfiguracja);die;          ?>
                @foreach($konfiguracja as $value)
                    @foreach($value as $k => $v)
                    <tr>
                        <td>{{$k}}</td>
                        <td>{{$v}}</td>
                    </tr>
                        @endforeach
                    @endforeach
            </table>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 heading-text">
                <h2>Dodaj konfiguracje projektu</h2>
                <a class="btn-back" href="{{url()->route('projekty.index')}}">Powrót</a>
            </div>
            @include('layouts.form.form_template_table',['url'=>'/projekty/konfiguracja/'.$id_projektu,'form'=>$form])
        </div>
    </div>
@endsection