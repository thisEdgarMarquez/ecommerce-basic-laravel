@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">ENTRADAS</h1>
	<a href="{{route('agregarEntrada')}}">
		<button class="btn btn-success btn-lg"> <i class="fa fa-plus"></i> Agregar</button>
	</a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Monto</th>						
                        <th>Cliente</th>
                        <th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($facturas as $factura)
					<tr data-id="{{$factura->id}}">
						<td>{{$factura->id}}</td>
                        <td>{{ $factura->fecha }}</td>
                        <td>{{$factura->monto}} BsF</td>
						<td>{{ $factura->usuario_pk['nombre'] }}</td>						
						<td>@if($factura->status) Despachada @else Sin despachar @endif</td>
						<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="{{route('editarEntrada',['id' => $factura->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="{{route('detallesFactura',['id' => $factura->id])}}" class="btn btn-sm btn-primary">
									Detalles <i class="fas fa-eye"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar la entrada?','{{route('eliminarEntrada')}}',{{$factura->id}});"  class="btn btn-sm btn-danger">
									Eliminar <i class="fas fa-trash "></i>
								</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div id="ajaxRespuesta"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{$facturas->render()}}
	</div>
</div>
@endsection