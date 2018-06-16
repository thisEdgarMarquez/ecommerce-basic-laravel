@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
    <h1 class="text-uppercase">PAGOS</h1>
    <a href="{{route('agregarPago')}}">
        <button class="btn btn-success btn-lg"> <i class="fa fa-plus"></i> Agregar</button>
    </a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Cliente</th>
                        <th># Factura</th>
                        <th>Tipo pago</th>
                        <th>Monto</th>
                        <th>Nombre Banco</th>
                        <th># Referencia</th>
                        <th>Adjunto</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Acción</th>
					</tr>
				</thead>
				<tbody>
					@foreach($pagos as $pago)
					<tr data-id="{{$pago->id}}">
                        <td>{{ $pago->id }}</td>
                        @foreach($pago->usuario_pk as $usuario)
                        <td>{{ $usuario->nombre }}</td>
                        @endforeach
                        <td>{{$pago->idfactura}}</td>
                        <td>
                            @switch($pago->tipo_pago)
                                @case('1')
                                Efectivo
                                @break
                                @case('2')
                                Transferencia
                                @break
                                @case('3')
                                Cheque
                                @break
                                @default
                                @break
                            @endswitch
                        </td>
                        <td>{{$pago->monto}}</td>
                        <td>{{$pago->nombre_banco ? $pago->nombre_banco : 'No posee'}}</td>
                        <td>{{$pago->numero_referencia ? $pago->numero_referencia : 'No posee'}}</td>
                        <td>
                            @if($pago->adjunto)
                            <a href="{{asset('uploads/')}}{{$pago->adjunto}}">Ver</a>
                            @else 
                            No posee
                            @endif
                        </td>
                        <td>
                            @switch($pago->status)
                                @case('0')
                                En espera
                                @break;
                                @case('1')
                                Aprobado
                                @break;
                                @case('2')
                                Rechazado
                                @break;
                            @endswitch
                        </td>
                        <td>{{$pago->created_at}}</td>
                        <td>
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
                                <a href="#" onClick="return confirmacion('¿Estás seguro de aprobar este pago?','{{route('aprobarPago')}}',{{$pago->id}},false);"  class="{{$pago->status == 1 ? 'disabled' : ''}} btn btn-sm btn-success">
                                        Aprobar <i class="fas fa-checked "></i>
                                    </a>
                                    <a href="#" onClick="return confirmacion('¿Estás seguro de rechazar este pago?','{{route('rechazarPago')}}',{{$pago->id}},false);"  class="{{$pago->status == 2 ? 'disabled' : ''}} btn btn-sm btn-warning">
                                        Rechazar <i class="fas fa-checked "></i>
                                    </a>
								<a href="{{route('editarPago',['id' => $pago->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar el pago?','{{route('eliminarPago')}}',{{$pago->id}});"  class="btn btn-sm btn-danger">
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
		{{$pagos->render()}}
	</div>
</div>
@endsection