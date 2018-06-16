@extends('admin.layouts.app')
@section('content')

<div class="jumbotron text-center">
	<h1 class="text-uppercase">AGREGAR ENTRADA</h1>
</div>

<div class="col-md-12">
    <div>
            <form method="POST" action="{{route('crearEntrada')}}">
                {{csrf_field()}}
                    <div class="form-group row">
                      <label for="idproveedor" class="col-4 col-form-label">Proveedor</label> 
                      <div class="col-8">
                        <select class="custom-select" name="idproveedor">
                            @foreach($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha" class="col-4 col-form-label">Fecha</label> 
                            <div class="col-8">
                                <input type="text" name="fecha" class="form-control input-lg" id="fechaEntrada">
                            </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="status" class="custom-select" required="required">
                          <option value="1">Activo</option>
                          <option value="0">Desactivado</option>
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                            <table class="table table-striped table-bordered table-hover" id="prendasEntrada">
                                    <thead>
                                        <tr>
                                            <th>Prenda</th>
                                            <th>Talla</th>
                                             <th>Cantidad</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="idprenda" class="custom-select input-lg" id="idprenda" onchange="actualizarTallaPrenda(this,document.getElementById('idtalla'),'{{route('gettallas')}}')">
                                                    @foreach($prendas as $prenda)
                                                        <option value="{{$prenda['id']}}">{{$prenda['nombre']}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>                                                
                                                <select name="idtalla" class="custom-select input-lg" id="idtalla">
                                                    @foreach($tallas as $talla)
                                                        <option value="{{$talla['id']}}">{{$talla['medida']}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                           
                                            <td class="col-md-3"><input type="number" name="cantidad" class="form-control" min="1" id="cantidad"></td>
                                            
                                            <td>
                                            <div class="col-md-12 text-center"><button onclick="return agregarPrenda()" class="btn btn-success" ><i class="fas fa-plus "></i></button></div>    
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    <div class="text-center">
                        <button name="submit" type="submit" class="btn btn-primary">Crear</button>
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