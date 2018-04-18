@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="text-center">
        <a href="{{route('agregarProveedor')}}">
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
                        <th>Cedula</th>
                        <th>RIF</th>
                        <th>Teléfono 1</th>
                        <th>Teléfono 2</th>
                        <th>Correo Electrónico</th>
                        <th>Dirección</th>
                        <th>Estado</th>
					</tr>
				</thead>
				<tbody>
					@foreach($proveedores as $proveedor)
					<tr data-id="{{$proveedor->id}}">
                        <td>{{$proveedor->nombre}}</td>
                        <td>{{$proveedor->cedula}}</td>
                        <td>{{$proveedor->rif}}</td>
                        <td>{{$proveedor->telefono1}}</td>
                        <td>{{$proveedor->telefono2}}</td>
                        <td>{{$proveedor->email}}</td>
                        <td>{{$proveedor->direccion}}</td>
                        @if($proveedor->status)
							<td>Activo</td>
						@else
							<td>Desactivado</td>
                        @endif
                        <td>
                            <a href="{{route('editarProveedor',['id' => $proveedor->id])}}"><i class="fas fa-pencil-alt"></i></a>
							<a href="#" onClick="return confirmacion('¿Estas seguro de eliminar el proveedor?','{{route('eliminarProveedor')}}',{{$proveedor->id}});"><i class="fas fa-trash "></i></a>
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
		{{$proveedores->render()}}
	</div>
</div>
@endsection