@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<a href="{{route('agregarMarca')}}">
			<button class="btn btn-success">Agregar</button></a>
		</div>
	</div>
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
							<a href="{{route('editarMarca',['id' => $marca->id])}}"><i class="fas fa-pencil-alt"></i></a>
							<a href="#" onClick="return confirmacion('¿Estas seguro de eliminar la marca?','{{route('eliminarMarca')}}',{{$marca->id}});"><i class="fas fa-trash "></i></a>
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