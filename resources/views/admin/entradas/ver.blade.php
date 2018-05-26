@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">DETALLES DE PRENDA</h1>
</div>

<div class="row">
	<div class="col-md-12">
        <table cellpadding="10">
        @foreach($entrada as $data)
            <tr><td><b class="text-primary"> Código </b> </td><td> {{'ENTR-'.$data->id}}</td></tr>
            <tr><td><b class="text-primary"> Proveedor </b> </td><td> {{$data->proveedor_pk->nombre}}</td></tr>
            <tr><td><b class="text-primary"> Fecha de ingreso </b> </td><td> {{$data->fecha}}</td></tr>
            <tr><td><b class="text-primary"> Estado </b> </td><td> {{($data->status==1)? 'Activa' : 'Desactivada'}}</td></tr>
        @endforeach
        <table>
        <br>
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
