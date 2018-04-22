@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">COLORES</h1>
	<a href="{{route('agregarColor')}}">
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
						<th>HEX</th>
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
					@foreach($colores as $color)
					<tr data-id="{{$color->id}}">
						<td>{{ $color->nombre }}</td>
						<td>{{ $color->hex }}</td>
						@if($color->status)
							<td>Activa</td>
						@else
							<td>Desactivada</td>
						@endif
						<td>
							<a href="{{route('editarColor',['id' => $color->id])}}"><i class="fas fa-pencil-alt"></i></a>
							<a href="#" onClick="return confirmacion('¿Estas seguro de eliminar el color?','{{route('eliminarColor')}}',{{$color->id}});"><i class="fas fa-trash "></i></a>
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
		{{$colores->render()}}
	</div>
</div>
@endsection