@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="text-center">
        <h3>Agregar entrada</h3>
    </div>
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
                                            <th>Color</th>
                                            <th>Cantidad</th>
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
                                            <td>                                                
                                                <select name="idcolor" class="custom-select input-lg" id="idcolor">
                                                    @foreach($colores as $color)
                                                        <option value="{{$color['id']}}">{{$color['nombre']}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="col-md-3"><input type="number" name="cantidad" class="form-control" min="1" id="cantidad"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12 text-center"><button onclick="return agregarPrenda()" class="btn btn-success" ><i class="fas fa-plus "></i></button></div>
                            </div>
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Crear</button>
                      </div>
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