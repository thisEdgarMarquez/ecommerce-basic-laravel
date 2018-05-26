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
						<th>Código</th>
						<th>Fecha</th>
						<th>Proveedor</th>						
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($entradas as $entrada)
					<tr data-id="{{$entrada->id}}">
						<td>ENTR-{{$entrada->id}}</td>
						<td>{{ $entrada->fecha }}</td>
						<td>{{ $entrada->proveedor_pk['nombre'] }}</td>						
						<td>@if($entrada->status) Activa @else Desactivada @endif</td>
						<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="{{route('editarEntrada',['id' => $entrada->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="{{route('entradaDetalles',['id' => $entrada->id])}}" class="btn btn-sm btn-primary">
									Detalles <i class="fas fa-eye"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar la entrada?','{{route('eliminarEntrada')}}',{{$entrada->id}});"  class="btn btn-sm btn-danger">
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
		{{$entradas->render()}}
	</div>
</div>
@endsection