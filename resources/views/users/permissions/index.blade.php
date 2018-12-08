@extends('layouts.logged')

@section('main-section')
    @include('layouts.navigation.navigation-users')


    <div class="col-md-12">
        <div class="col-md-6">

        </div>
    </div>
    <div class="col-md-12 text-right">

    </div>
    <div class="col-md-12 table-wrap">
        @if($permissions)
            @foreach($permissions as $v => $pe)
            <div class="col-md-6">
                <div class="col-md-12" style="border-bottom: 2px solid #bbb; margin-bottom:40px;">
                    <h3>Uprawnienia dla konta {{$v}}</h3>
                </div>
                @if(count($pe) > 0)
                <table class="table table-hover table-bordered table-center">
                    <thead>
                    <tr>
                        <td>Moduł</td>
                        <td>Akcja</td>
                        <td>Pozwolenie</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pe as $p)
                        <tr>
                            <td>
                                {{$p->module}}
                            </td>
                            <td>
                                {{$p->name}}
                            </td>
                            <td>
                                @if($p->permission)
                                    <a href="{{url()->route('users.permissionschange',array('id'=>$p->id))}}"><span class="btn-yes">Tak</span></a>
                                @else
                                    <a href="{{url()->route('users.permissionschange',array('id'=>$p->id))}}"><span class="btn-no">Nie</span></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @else
                    <h2 style="text-align:center; font-style: italic; color: #999;">Brak wyników</h2>
                @endif
            </div>
            @endforeach;
            @endif;
    </div>
@endsection