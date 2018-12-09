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
            <div class="col-md-12">
                <div class="col-md-12" style="border-bottom: 2px solid #bbb; margin-bottom:40px;">
                    <h3>Uprawnienia</h3>
                </div>
                <table class="table table-hover table-bordered table-center">
                    <thead>
                    <tr>
                        <td>Menu</td>
                        <td>Moduł</td>
                        <td>Akcja</td>
                        <td>Root</td>
                        <td>Admin</td>
                        <td>User</td>
                        <td>Test</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $p)
                        <tr>
                            <td>
                                {{$p['module']}}
                            </td>
                            <td>
                                @php
                                    $action =  $p['action'];
                                    $tab = explode('.',$action);
                                    $zakładka = count($tab) == 3 ? $tab[1] : '';
                                @endphp
                                <strong>{{$zakładka}}</strong>
                            </td>
                            <td class="text-left" style="padding-left:40px;">

                                {{$p['name']}}
                            </td>
                            @for($i=1; $i<5; $i++)
                                <?php $pe = $p['permissions'][$i]; ?>
                            <td>
                                @if($pe['permission'])
                                    <a href="{{url()->route('users.permission.change',array('id'=>$pe['id']))}}"><span class="btn-yes">Tak</span></a>
                                @else
                                    <a href="{{url()->route('users.permission.change',array('id'=>$pe['id']))}}"><span class="btn-no">Nie</span></a>
                                @endif
                            </td>
                                @endfor
                        </tr>
                    @endforeach;
                    </tbody>
                </table>
            </div>

        @else
            <h2 style="text-align:center; font-style: italic; color: #999;">Brak wyników</h2>
        @endif
    </div>
@endsection