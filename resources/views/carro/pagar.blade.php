@extends('layouts.app')
@section('content')
<div class="container" id="pagar-container">
    @if(!isset($msj))
        <form class="form-horizontal" id="form-pago" method="POST" action="{{route('pagarPOST')}}"  enctype="multipart/form-data"> 
            {{csrf_field()}}
        <div class="row" style="margin-top:20px;">
            <div class="col-md-4">
                <h3>Datos de factura</h3>
                <table cellpadding="10">
                    @foreach($factura as $detalles)
                        <tr><td><b class="text-primary"> # Factura </b> </td><td> {{$detalles->id}}<input type="hidden" name="idfactura" value="{{$detalles->id}}"/></td></tr>
                        <tr><td><b class="text-primary"> Fecha de ingreso </b> </td><td> {{$detalles->created_at}}</td></tr>
                        <tr><td><b class="text-primary"> Monto </b> </td><td> {{$detalles->monto}} BsF</td></tr>
                    @endforeach
                </table>
            </div>
            <div class="col-md-8">
                
                    <div class="form-group">
                        <label for="tipo_pago" class="control-label col-xs-4">Tipo de pago</label> 
                        <div class="col-xs-8">
                        <select id="tipo_pago" name="tipo_pago" required="required" class="select form-control">
                            <option selected disabled>Seleccionar</option>
                            <option value="1">Efectivo</option>
                            <option value="2">Transferencia</option>
                            <option value="3">Cheque</option>
                        </select>
                        </div>
                    </div>
                    <div id="form-body" style="display: none;">
                        
                    </div>
                    <div class="alert alert-primary" style="margin-top:50px;text-align: center;display: none;" id="alert-pago">
                        <ul>
                            <li style="list-style:none;text-align:center">Recuerde que debe dirigirse a una de nuestras sucursales para que su pago sea y su pedido despachado.</li>
                        </ul>
                    </div>
                    <div class="col-md-12" id="container-button" style="display: none">
                            <button name="submit" type="submit" class="btn btn-primary">Pagar</button>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
            </div>
        </div>
        </form>
    @else
        @if($msj['error'])
        <div class="alert alert-danger" style="margin-top:50px;text-align: center;">
            <ul>
                <li style="list-style:none;text-align:center">{{$msj['msj']}}</li>
            </ul>
        </div>
        @else
        <div class="alert alert-success" style="margin-top:50px;text-align: center;">
                <ul>
                    <li style="list-style:none;text-align:center">{{$msj['msj']}}</li>
                </ul>
            </div>
        @endif
    @endif
</div>
@endsection