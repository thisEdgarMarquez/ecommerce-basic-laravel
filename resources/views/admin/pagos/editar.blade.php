@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
  <div class="jumbotron text-center">
    <h1 class="text-uppercase">EDITAR PAGO</h1>
  </div>
    <div>
    <form class="form-horizontal" id="form-pago" method="POST" action="{{route('actualizarPago')}}"  enctype="multipart/form-data"> 
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$pago->id}}" />
        <div class="row" style="margin-top:20px;">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="tipo_pago_admin" class="control-label col-xs-4">Tipo de pago</label> 
                    <div class="col-xs-12">
                    <select id="tipo_pago_admin" name="tipo_pago" required="required" class="select form-control">

                        <option value="1" {{$pago->tipo_pago == 1 ? 'selected=1' : ''}}>Efectivo</option>
                        <option value="2" {{$pago->tipo_pago == 2 ? 'selected=1' : ''}}>Transferencia</option>
                        <option value="3" {{$pago->tipo_pago == 3 ? 'selected=1' : ''}}>Cheque</option>
                    </select>
                    </div>
                </div>
                <div id="form-body">
                    <div class="form-group">
                            <label for="idfactura" class="control-label col-xs-4"># Factura</label> 
                            <div class="col-xs-12">
                            <input value="{{$pago->idfactura}}" type="text" id="idfactura" class="form-control" required name="idfactura">
                            </div>
                        </div>
                        
                    <div class="form-group">
                            <label for="cedula_cliente" class="control-label col-xs-4">Cedula cliente</label> 
                            <div class="col-xs-12">
                            <input value={{$usuario->cedula}}  type="text" id="cedula_cliente" class="form-control" required name="cedula_cliente">
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="nombre_banco" class="control-label col-xs-4">Banco</label> 
                        <div class="col-xs-12">
                        <input {{$pago->nombre_banco ? "value=$pago->nombre_banco" : 'disabled'}} id="nombre_banco" type="text" class="form-control" name="nombre_banco">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numero_referencia" class="control-label col-xs-4"># Referencia</label> 
                        <div class="col-xs-12">
                        <input {{$pago->numero_referencia ? "value=$pago->numero_referencia" : 'disabled'}} type="text" id="numero_referencia" class="form-control" name="numero_referencia">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="monto" class="control-label col-xs-4">Monto</label> 
                        <div class="col-xs-12">
                        <input value="{{$pago->monto}}" type="text" id="monto" required class="form-control" name="monto">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adjunto" class="col-4 col-form-label">Adjunto</label> 
                        <div class="col-8">
                            @if($pago->adjunto)
                                <input value  class="form-control" type="file" name="adjunto" accept="image/*">
                            @else
                            <input disabled value  class="form-control" type="file" name="adjunto" accept="image/*">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-8">
                            <input class="btn btn-primary" type="submit" name="enviar" value="Editar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('msj'))
            <div class="alert alert-info text-center">
                {{ session('msj') }}
            </div>
        @endif
    </div>
</div>
@endsection