@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-projekty')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
        <div class="col-md-6 text-right">
            @include('layouts.form.form_template_inline',array('url'=>'/projekty/manage','form'=>$form))
        </div>
    </div>
    <div class="col-md-12 manage-panel">
        <div class="col-md-3 sidebar-pages">
            <div class="row">
                <div class="col-md-8">
                    <h2>Strony</h2>
                </div>
                <div class="col-md-4 text-right" style="margin-top:20px; margin-bottom:10px;">
                    <a href="{{url()->route('projekty.manage.addpage',array('id'=>$id))}}" class="btn btn-add">Dodaj</a>
                </div>
            </div>
            <div class="pages-content">
                <ul>
                @foreach ($pages as $p)
                        <li class="{{$p->slug == "main_page" ? 'custom-element' :'subpage'}}"><a href="{{url()->route('projekty.manage')}}?id={{$p->id}}&page={{$p->nazwa}}">{{$p->nazwa}}<a style="display: {{$p->slug == "main_page"? 'none':'block'}}" class="delete-page" href="{{url()->route('projekty.manage.deletepage',array('id'=>$p->id))}}"><img src="/img/rubbish-bin.svg" width="10"/> </a></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9 main-content">
            @include('layouts.form.form_template_page_content',array('url'=>'/projekty/manage/addContent?id='.$id,'form'=>$formContent))
        </div>
    </div>

@endsection