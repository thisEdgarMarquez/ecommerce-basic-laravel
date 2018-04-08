@extends('admin.layouts.app')
@section('content')
<div class="text-center">
	<a href="{{route('agregarCategorias')}}">
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
				@foreach($categorias as $categoria)
				<tr>
					<td>{{ $categoria->nombre }}</td>
					<td>{{ $categoria->descripcion }}</td>
						@if($categoria->estado)
							<td>Desactivada</td>
						@else
							<td>Activa</td>
						@endif
					<td>
						<a href="" class="btn btn-primary">
							<i class="fa fa-pencil-square"></i>
						</a>
						<form>
							<input type="hidden" name="_method" value="DELETE">
								<button onClick="return confirm('Eliminar registro?')" class="btn btn-danger">
									<i class="fa fa-trash-o"></i>
								</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

@endsection