@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">PROVEEDORES</h1>
	<a href="{{route('agregarProveedor')}}">
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
                        <th>Cédula</th>
                        <th>RIF</th>
                        <th>Teléfono 1</th>
                        <th>Teléfono 2</th>
                        <th>Correo Electrónico</th>
                        <th>Dirección</th>
						<th>Estado</th>
						<th>Acción</th>
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
							<div class="btn-group btn-group-xs btn-group-sm" role="group" aria-label="...">
								<button class="btn btn-info">
									<a href="{{route('editarProveedor',['id' => $proveedor->id])}}" class="btn btn-sm btn-info">
										Editar <i class="fas fa-pencil-alt"></i>
									</a>
								</button>
								<button class="btn btn-danger">
									<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar el Proveedor?','{{route('eliminarProveedor')}}',{{$proveedor->id}});" class="btn btn-sm btn-danger">
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
		{{$proveedores->render()}}
	</div>
</div>
@endsection