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
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Muestra</th>
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($colores as $color)
					<tr data-id="{{$color->id}}">
						<td>{{ $color->nombre }}</td>
						<td> <span class="muestra-color" style="{{'background-color: #'.$color->hex }}"></span></td>
						@if($color->status)
							<td>Activa</td>
						@else
							<td>Desactivada</td>
						@endif
						<td>							
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="{{route('editarColor',['id' => $color->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar el Color?','{{route('eliminarColor')}}',{{$color->id}});"  class="btn btn-sm btn-danger">
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
		{{$colores->render()}}
	</div>
</div>
@endsection