@extends('admin.layouts.app')
@section('content')
<div class="text-center">
	<a href="{{route('agregarCategoria')}}">
	<button class="btn btn-success">Agregar</button></a>
</div>
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
				@foreach($categorias as $categoria)
				<tr data-id="{{$categoria->id}}">
					<td>{{ $categoria->nombre }}</td>
					<td>{{ $categoria->descripcion }}</td>
						@if($categoria->estado)
							<td>Desactivada</td>
						@else
							<td>Activa</td>
						@endif
					<td>
						<a href="{{route('editarCategoria',['id' => $categoria->id])}}"><i class="fas fa-pencil-alt"></i></a>
						<a href="#" onClick="return confirmacion('¿Estas seguro de eliminar el registro?','{{route('eliminarCategoria')}}',{{$categoria->id}});"><i class="fas fa-trash "></i></a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div id="ajaxRespuesta"></div>
	</div>

@endsection