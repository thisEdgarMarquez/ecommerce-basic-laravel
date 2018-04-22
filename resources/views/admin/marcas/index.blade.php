@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">MARCAS</h1>
	<a href="{{route('agregarMarca')}}">
		<button class="btn btn-success btn-lg"> <i class="fa fa-plus"></i> Agregar</button>
	</a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($marcas as $marca)
					<tr data-id="{{$marca->id}}">
						<td>{{ $marca->nombre }}</td>
						<td>{{ $marca->descripcion }}</td>
						@if($marca->status)
							<td>Activa</td>
						@else
							<td>Desactivada</td>
						@endif
						<td>
							<div class="btn-group btn-group-xs btn-group-sm" role="group" aria-label="...">
								<button class="btn btn-info">
									<a href="{{route('editarMarca',['id' => $marca->id])}}" class="btn btn-sm btn-info">
										Editar <i class="fas fa-pencil-alt"></i>
									</a>
								</button>
								<button class="btn btn-danger">
									<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar la Marca?','{{route('eliminarMarca')}}',{{$marca->id}});"  class="btn btn-sm btn-danger">
										Eliminar <i class="fas fa-trash "></i>
									</a>
								</button>
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
		{{$marcas->render()}}
	</div>
</div>
@endsection