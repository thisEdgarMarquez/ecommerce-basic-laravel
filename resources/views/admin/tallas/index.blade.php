@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<a href="{{route('agregarTalla')}}">
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
						<th>Medida</th>
						<th>Estado</th>
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
                            <a href="{{route('editarTalla',['id' => $talla->id])}}"><i class="fas fa-pencil-alt"></i></a>
                            <a href="#" onClick="return confirmacion('¿Estas seguro de eliminar la talla?','{{route('eliminarTalla')}}',{{$talla->id}});"><i class="fas fa-trash "></i></a>
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