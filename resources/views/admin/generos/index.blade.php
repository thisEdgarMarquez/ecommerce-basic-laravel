@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">GÉNEROS</h1>
	<a href="{{route('agregarGenero')}}">
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
						<th>Estado</th>
						<th>Acción</th>
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
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="{{route('editarGenero',['id' => $genero->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar el Género?','{{route('eliminarGenero')}}',{{$genero->id}});"  class="btn btn-sm btn-danger">
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
		{{$generos->render()}}
	</div>
</div>
@endsection