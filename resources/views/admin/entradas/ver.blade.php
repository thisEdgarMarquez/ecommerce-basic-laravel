@extends('admin.layouts.app')
@section('content')
<div class="row">
	<div class="col-md-12">
        @foreach($entrada as $data)
        <label>Proveedor:{{$data->proveedor_pk->nombre}}</label>
        <label>Fecha de ingreso:{{$data->fecha}}</label>
        <label>Estado: @if($data->status == 1) Activa @else Desactivada @endif</label>
        @endforeach
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
                        <th>Prenda</th>
						<th>Talla</th>
                        <th>Cantidad</th>                        
					</tr>
				</thead>
				<tbody>
                    @foreach($entrada as $data)
                    @foreach($data->entradastallas_pk as $detalles_entrada)
                        <tr>
                            <td>
                                @foreach($prendas as $prenda)
                                    @if($prenda->id == $detalles_entrada->idprenda)
                                    {{$prenda->nombre}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($tallas as $talla)
                                    @if($talla->id == $detalles_entrada->idtalla)
                                    {{$talla->medida}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$detalles_entrada->cantidad}}</td>
                        </tr>
                    @endforeach
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
