@extends('layouts.logged')

@section('main-section')

    <div class="col-md-12 heading-text">
        <h2>Edytuj wpis</h2>
        <a class="btn-back" href="{{url()->route('cms.posts')}}">Powrót</a>
    </div>
    @include('layouts.form.form_template_page_content',['url'=>'/cms/posts/edit/'.$id,'form'=>$form,'description'=>$content])

@endsection