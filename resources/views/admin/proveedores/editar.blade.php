@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="text-center">
        <h3>Agregar proveedor</h3>
    </div>
    <div>
    <form method="POST" action="{{route('actualizarProveedor')}}">
                {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$proveedor->id}}"/>
                    <div class="form-group row">
                      <label for="nombre" class="col-4 col-form-label">Nombre</label> 
                      <div class="col-8">
                        <input id="nombre" name="nombre" class="form-control here" required="required" type="text" value="{{$proveedor->nombre}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="cedula" class="col-4 col-form-label">Cedula de identidad</label> 
                        <div class="col-8">
                          <input id="cedula" name="cedula" class="form-control here"  type="number" value="{{$proveedor->cedula}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="rif" class="col-4 col-form-label">RIF</label> 
                        <div class="col-8">
                          <input id="rif" name="rif" class="form-control here" type="text" value="{{$proveedor->rif}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="telefono1" class="col-4 col-form-label">Teléfono 1</label> 
                        <div class="col-8">
                          <input id="telefono1" name="telefono1" class="form-control here" required="required" type="number" value="{{$proveedor->telefono1}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="telefono2" class="col-4 col-form-label">Teléfono 2</label> 
                        <div class="col-8">
                          <input id="telefono2" name="telefono2" class="form-control here" type="number" value="{{$proveedor->telefono2}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-4 col-form-label">Correo Electrónico</label> 
                        <div class="col-8">
                          <input id="email" name="email" class="form-control here" required="required" type="email" value="{{$proveedor->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="direccion" class="col-4 col-form-label">Dirección</label> 
                        <div class="col-8">
                        <textarea id="direccion" name="direccion" cols="40" rows="5" class="form-control" required="required">{{$proveedor->direccion}}</textarea>
                        </div>
                      </div>
                    <div class="form-group row">
                      <label for="status" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="status" class="custom-select" required="required">
                            @if($proveedor->status)
                                <option selected value="1">Activa</option>
                                <option value="0">Desactivada</option>
                            @else
                                <option value="1">Activa</option>
                                <option selected value="0">Desactivada</option>
                            @endif
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
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