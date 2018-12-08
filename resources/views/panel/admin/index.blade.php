@extends('layouts.logged')

@section('main-section')
    <div class="col-md-12">
        <div class="col-md-6">

        </div>
    </div>
    <div class="col-md-12 text-center">
       <h2 style="margin-bottom:40px;">Panel administracyjny</h2>
    </div>
    <div class="col-md-12 table-wrap">
        <div class="col-md-6">
            <table class="table table-hover table-bordered table-center">
                <tbody>
                    <tr>
                        <td>Dodaj brakujące moduły</td>
                        <td><a class="btn btn-standard" href="{{url()->route('panel.addModules')}}">Dodaj</a> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection