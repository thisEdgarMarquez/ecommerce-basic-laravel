@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">USUARIOS</h1>
	<a href="{{route('agregarUsuario')}}">
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
                        <th>Apellido</th>
                        <th>Correo Electrónico</th>
                        <th>Nivel</th>
						<th>Teléfono 1</th>
						<th>Teléfono 2</th>
						<th>Cédula</th>
						<th>RIF</th>
						<th>Dirección</th>
						<th>Estado</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($usuarios as $usuario)
					<tr data-id="{{$usuario->id}}">
						<td>{{$usuario->nombre}}</td>
						<td>{{$usuario->apellido}}</td>
						<td>{{$usuario->email}}</td>
						<td>@if($usuario->nivel == 1) Usuario @else Administrador @endif</td>
						<td>{{$usuario->telefono1}}</td>
						<td>{{$usuario->telefono2}}</td>
						<td>{{$usuario->cedula}}</td>
						<td>{{$usuario->rif}}</td>
						<td>{{$usuario->direccion}}</td>
						<td>@if($usuario->status) Activo @else Desactivado @endif</td>
						<td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="{{route('editarUsuario',['id' => $usuario->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estas seguro de eliminar el Usuario?','{{route('eliminarUsuario')}}',{{$usuario->id}});" class="btn btn-sm btn-danger">
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
		{{$usuarios->render()}}
	</div>
</div>
@endsection