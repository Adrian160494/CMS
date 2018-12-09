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
                    <a href="{{url()->route('projects.manage.addpage',array('id'=>$id))}}" class="btn btn-add">Dodaj</a>
                </div>
            </div>
            <div class="pages-content">
                <ul>
                @foreach ($pages as $p)
                        <li class="{{$p->slug == "main_page" ? 'custom-element' :'subpage'}}"><a href="{{url()->route('projects.manage')}}?id={{$p->id}}&page={{$p->nazwa}}&slug={{$p->slug}}">{{$p->nazwa}}<a style="display: {{$p->slug == "main_page"? 'none':'block'}}" class="delete-page" href="{{url()->route('projects.manage.deletepage',array('id'=>$p->id))}}"><img src="/img/rubbish-bin.svg" width="20"/> </a></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9 main-content">
            <div class="page-url-route">
                <div class="col-md-2">
                    <a class="btn btn-standard" href="http://{{$projektUrl}}{{$route}}">Zobacz</a>
                </div>
                <div class="col-md-10 page-route-wrap">
                    <p>Adres: {{$projektUrl}}</p>
                    @include('layouts.form.form_template_inline',array('url'=>'/projekty/manage/changeRoute?id_projektu='.$id.'&page_name='.$nazwa_strony,'form'=>$form3,'leftContent'=>true))
                </div>
            </div>
            @include('layouts.form.form_template_page_content',array('url'=>'/projekty/manage/addContent?id_projektu='.$id.'&slug='.$slug,'form'=>$formContent,'content'=>$content))
        </div>
    </div>

@endsection