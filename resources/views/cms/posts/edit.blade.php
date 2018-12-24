<style>
    .main-content-post{
        visibility: hidden;
        position: absolute !important;
        top:0;
        right:0;
        width: 74.5% !important;
    }
    .edit-post-basic{
        visibility: visible;
    }
    .pages-content li i{
        margin-right: 10px;
    }
    .pages-content li.active{
        background: #d7d7d7;
    }
</style>
@extends('layouts.logged')

@section('main-section')
    <div class="col-md-12 heading-text">
        <h2>Edytuj wpis</h2>
        <a class="btn-back" href="{{url()->route('cms.posts')}}">Powrót</a>
    </div>
    <div class="col-md-12 manage-panel">
        <div class="col-md-3 sidebar-pages">
            <div class="pages-content">
                <ul>
                    <li class="basic-data-edit active" data-id="basic"><a href="javascript: void(0)"><i class="fas fa-wrench"></i>Dane podstawowe</a></li>
                    <li class="detail-data-edit" data-id="detail"><a href="javascript: void(0)"><i class="fas fa-cog"></i>Dane szczegołowe</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 main-content main-content-post edit-post-basic" style="background: rgba(250, 250, 250, 0.8);">
            @include('layouts.form.form_template_page_content',['url'=>'/cms/posts/edit/'.$id,'form'=>$form,'description'=>$content])
        </div>
        <div class="col-md-9 main-content main-content-post edit-post-detail" style="background: rgba(250, 250, 250, 0.8);">
            @include('layouts.form.form_template_page_content',['url'=>'/cms/posts/edit/'.$id,'form'=>$form2,'description'=>$content])
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.pages-content li').bind('click',function () {
                $('.pages-content li').each(function () {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');
                $('.main-content').each(function () {
                    $(this).css('visibility','hidden');
                });
                var content = $(this).data('id');
                $('.edit-post-'+content).css('visibility','visible');
            })
        })
    </script>
@endsection
