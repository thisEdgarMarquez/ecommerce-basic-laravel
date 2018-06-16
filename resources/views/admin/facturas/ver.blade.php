@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">DETALLES DE FACTURA</h1>
</div>

<div class="row">
	<div class="col-md-12">
        <table cellpadding="10">
        @foreach($factura as $detalles)
            <tr><td><b class="text-primary"> # </b> </td><td> {{$detalles->id}}</td></tr>
            <tr><td><b class="text-primary"> Cliente </b> </td><td> {{$detalles->usuario_pk->nombre}}</td></tr>
            <tr><td><b class="text-primary"> Fecha de ingreso </b> </td><td> {{$detalles->fecha}}</td></tr>
            <tr><td><b class="text-primary"> Estado </b> </td><td> {{($detalles->status)? 'Despachada' : 'Sin despachar'}}</td></tr>
            <tr><td><b class="text-primary"> PDF </b> </td><td><a href="{{route('pdfFactura',$detalles->id)}}" class="btn btn-danger">Generar</a></td></tr>
        @endforeach
        <table>
        <br>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
                        <th>Prenda</th>
                        <th>Talla</th>
                <th>Cantidad</th>                        
					</tr>
				</thead>
				<tbody>
                    @foreach($detalles->facturaprendas_pk as $fp)
                    <tr>
                        <td>
                            @foreach($prendas as $prenda)
                                @if($fp->idprenda == $prenda->id)
                                {{$prenda->nombre}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($tallas as $talla)
                                @if($talla->id == $fp->idtalla)
                                {{$talla->medida}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$fp->cantidad}}</td>
</tr>
                    @endforeach
				</tbody>
			</table>
        </div>
    </div>
</div>
@endsection
