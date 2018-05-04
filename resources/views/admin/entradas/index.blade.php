@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
			<a href="{{route('agregarEntrada')}}">
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
						<th>Código</th>
						<th>Fecha</th>
						<th>Proveedor</th>						
						<th>Estado</th>
					</tr>
				</thead>
				<tbody>
					@foreach($entradas as $entrada)
					<tr data-id="{{$entrada->id}}">
						<td>ENTR-{{$entrada->id}}</td>
						<td>{{ $entrada->fecha }}</td>
						<td>{{ $entrada->proveedor_pk['nombre'] }}</td>						
						<td>@if($entrada->status) Activa @else Desactivada @endif</td>
						<td>
							<a href="{{route('entradaDetalles',['id' => $entrada->id])}}"><i class="fas fa-eye "></i></a>
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
		{{$entradas->render()}}
	</div>
</div>
@endsection