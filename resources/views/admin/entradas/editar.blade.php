@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
	<h1 class="text-uppercase">EDITAR ENTRADA</h1>
</div>
<div class="col-md-12">
    <div>
            <form method="POST" action="{{route('actualizarEntrada')}}">
                {{csrf_field()}}                
                    <div class="form-group row">
                     <input type="hidden" name="id" value="{{$entrada[0]['id']}}" />
                      <label for="idproveedor" class="col-4 col-form-label">Proveedor</label> 
                      <div class="col-8">
                        <select class="custom-select" name="idproveedor">
                            @foreach($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}" {{($proveedor->id==$entrada[0]->idproveedor)?'selected':''}}>{{$proveedor->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha" class="col-4 col-form-label">Fecha</label> 
                            <div class="col-8">
                                <input type="text" name="fecha" class="form-control input-lg" id="fechaEntrada" value="{{$entrada[0]->fecha}}">
                            </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="status" class="custom-select" required="required">
                          <option value="1" {{($entrada[0]->status == 1)?'selected':''}}>Activo</option>
                          <option value="0" {{($entrada[0]->status == 0)?'selected':''}}>Desactivado</option>
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                            <table class="table table-striped table-bordered table-hover" id="prendasEntrada">
                                    <thead>
                                        <tr>
                                            <th>Prenda</th>
                                            <th>Talla</th>
                                            <th>Color</th>
                                            <th>Cantidad</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="select_prendas" class="custom-select input-lg" id="idprenda" onchange="actualizarTallaPrenda(this,document.getElementById('idtalla'),'{{route('gettallas')}}')">
                                                    @foreach($prendas as $prenda)
                                                        <option value="{{$prenda['id']}}">{{$prenda['nombre']}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>                                                
                                                <select name="select_tallas" class="custom-select input-lg" id="idtalla">
                                                    @foreach($tallas as $talla)
                                                        <option value="{{$talla['id']}}">{{$talla['medida']}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>                                                
                                                <select name="select_color" class="custom-select input-lg" id="idcolor">
                                                    @foreach($colores as $color)
                                                        <option value="{{$color['id']}}">{{$color['nombre']}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="col-md-3">
                                                <input type="number" name="input_cantidad" class="form-control" min="1" id="cantidad">
                                            </td>                                                
                                            <td>
                                                <div class="col-md-12 text-center"><button onclick="return agregarPrenda()" class="btn btn-success" ><i class="fas fa-plus "></i></button></div>    
                                            </td>
                                        </tr>

<!-- prendas de esta entrada -->                                        
                                        @foreach($mapEntradaPrenda as $entrada)
                                        <tr class="tr-editar-entrada">
                                            <td>{{$entrada['_prenda']['nombre']}}</td>
                                            <td>{{$entrada['_talla']['medida']}}</td>
                                            <td>{{$entrada['_color']['nombre']}}</td>
                                            <td>{{$entrada['cantidad']}}</td>
                                            <td class="text-center">
                                                <button onClick="return eliminarPrendaEntrada({{$entrada['identrada_prenda']}});" type="button" class="btn btn-danger btn-rm-entrada"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
<!-- prendas de esta entrada -->

                                    </tbody>
                                </table>
                            </div>
                    <div class="text-center">
                        <button name="submit" type="submit" class="btn btn-primary">Editar</button>
                    </div>
                  </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('msj'))
                        <div class="alert alert-info text-center">
                            {{ session('msj') }}
                        </div>
                    @endif
    </div>
</div>
@endsection