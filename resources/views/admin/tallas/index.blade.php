@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">TALLAS</h1>
	<a href="{{route('agregarTalla')}}">
		<button class="btn btn-success btn-lg"> <i class="fa fa-plus"></i> Agregar</button>
	</a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Medida</th>
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tallas as $talla)
					<tr data-id="{{$talla->id}}">
						<td>{{ $talla->medida }}</td>
						@if($talla->status)
							<td>Activa</td>
						@else
							<td>Desactivada</td>
                        @endif
                        <td>
							<div class="btn-group btn-group-xs btn-group-sm" role="group" aria-label="...">
								<button class="btn btn-info">
									<a href="{{route('editarTalla',['id' => $talla->id])}}" class="btn btn-sm btn-info">
										Editar <i class="fas fa-pencil-alt"></i>
									</a>
								</button>
								<button class="btn btn-danger">
									<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar la Talla?','{{route('eliminarTalla')}}',{{$talla->id}});" class="btn btn-sm btn-danger">
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
		{{$tallas->render()}}
	</div>
</div>
@endsection