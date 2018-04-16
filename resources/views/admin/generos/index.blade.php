@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<a href="{{route('agregarGenero')}}">
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
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
					@foreach($generos as $genero)
					<tr data-id="{{$genero->id}}">
						<td>{{ $genero->nombre }}</td>
						@if($genero->status)
							<td>Activado</td>
						@else
							<td>Desactivado</td>
						@endif
						<td>
							<a href="{{route('editarGenero',['id' => $genero->id])}}"><i class="fas fa-pencil-alt"></i></a>
							<a href="#" onClick="return confirmacion('¿Estas seguro de eliminar el género?','{{route('eliminarGenero')}}',{{$genero->id}});"><i class="fas fa-trash "></i></a>
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
		{{$generos->render()}}
	</div>
</div>
@endsection