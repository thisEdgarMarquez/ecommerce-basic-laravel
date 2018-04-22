@extends('admin.layouts.app')
@section('content')


<div class="jumbotron text-center">
	<h1 class="text-uppercase">CATEGORÍAS</h1>
	<a href="{{route('agregarCategoria')}}">
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
					</tr>
				</thead>
				<tbody>
					@foreach($categorias as $categoria)
					<tr data-id="{{$categoria->id}}">
						<td>{{ $categoria->nombre }}</td>
						<td>{{ $categoria->descripcion }}</td>
						@if($categoria->status)
							<td>Activa</td>
						@else
							<td>Desactivada</td>
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
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		{{$categorias->render()}}
	</div>
</div>
@endsection