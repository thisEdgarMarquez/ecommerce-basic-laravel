@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<a href="{{route('agregarPrenda')}}">
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
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Categoria</th>
                        <th>Genero</th>
                        <th>Descripción</th>
                        <th>Cantidad Total</th>
                        <th>Estado</th>
					</tr>
				</thead>
				<tbody>
					@foreach($prendas as $prenda)
					<tr data-id="{{$prenda->id}}">
                        <td>{{$prenda->nombre}}</td>
                        <td>{{$prenda->precio}}</td>
                        <td>{{$prenda->marca_pk['nombre']}}</td>
                        <td>{{$prenda->categoria_pk['nombre']}}</td>
                        <td>{{$prenda->genero_pk['nombre']}}</td>
                        <td>{{$prenda->descripcion}}</td>
                        <td>{{$prenda->cantidad}}</td>
						@if($prenda->status)
							<td>Activa</td>
						@else
							<td>Desactivada</td>
                        @endif
                        <td>
                            <a href="{{route('editarPrenda',['id' => $prenda->id])}}"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" onClick="return confirmacion('¿Estas seguro de eliminar la prenda?','{{route('eliminarPrenda')}}',{{$prenda->id}});"><i class="fas fa-trash "></i></a>
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
		{{$prendas->render()}}
	</div>
</div>
@endsection