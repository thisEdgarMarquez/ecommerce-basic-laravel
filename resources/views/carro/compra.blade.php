@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        @if($msj['error'])
        <div class="alert alert-alert" style="margin-top:50px;text-align: center;">
            <ul>
                <li style="list-style:none;text-align:center"><h3>{{$msj['msj']}}</h3></li>
            </ul>
            <span><small><a href="/">Regresar</a></small></span>
        </div>
        @else
        <div class="alert alert-success" style="margin-top:50px;text-align: center;">
            <ul>
                <li style="list-style:none;text-align:center"><h3>{{$msj['msj']}}</h3></li>
            </ul>
            <span><small><a href="{{route('pagarGET',$msj['idfactura'])}}">Pagar</a></small></span>
        </div>
        @endif
    </div>
</div>
@endsection