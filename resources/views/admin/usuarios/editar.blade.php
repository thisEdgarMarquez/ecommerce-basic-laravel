@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="text-center">
        <h3>Editar usuario</h3>
    </div>
    <div>
    <form method="POST" action="{{route('actualizarUsuario')}}">
                {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$usuario->id}}">
                    <div class="form-group row">
                      <label for="nombre" class="col-4 col-form-label">Nombre</label> 
                      <div class="col-8">
                      <input id="nombre" name="nombre" class="form-control here" required="required" type="text" value="{{$usuario->nombre}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido" class="col-4 col-form-label">Apellido</label> 
                        <div class="col-8">
                          <input id="apellido" name="apellido" class="form-control here" required="required" type="text" value="{{$usuario->apellido}}">
                        </div>
                      </div>
                    <div class="form-group row">
                        <label for="cedula" class="col-4 col-form-label">Cedula de identidad</label> 
                        <div class="col-8">
                          <input id="cedula" name="cedula" class="form-control here"  type="number" value="{{$usuario->cedula}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="rif" class="col-4 col-form-label">RIF</label> 
                        <div class="col-8">
                          <input id="rif" name="rif" class="form-control here" type="text" value="{{$usuario->rif}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="telefono1" class="col-4 col-form-label">Teléfono 1</label> 
                        <div class="col-8">
                          <input id="telefono1" name="telefono1" class="form-control here" required="required" type="number" value="{{$usuario->telefono1}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="telefono2" class="col-4 col-form-label">Teléfono 2</label> 
                        <div class="col-8">
                          <input id="telefono2" name="telefono2" class="form-control here" type="number" value="{{$usuario->telefono2}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-4 col-form-label">Correo Electrónico</label> 
                        <div class="col-8">
                          <input id="email" name="email" class="form-control here" required="required" type="email" value="{{$usuario->email}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-4 col-form-label">Contraseña</label> 
                        <div class="col-8">
                          <input id="password" name="password" class="form-control here" type="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password_confirmation" class="col-4 col-form-label">Repetir Contraseña</label> 
                        <div class="col-8">
                          <input id="password_confirmation" name="password_confirmation" class="form-control here" type="password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="direccion" class="col-4 col-form-label">Dirección</label> 
                        <div class="col-8">
                          <textarea id="direccion" name="direccion" cols="40" rows="5" class="form-control" required="required">{{$usuario->descripcion}}</textarea>
                        </div>
                      </div>
                    <div class="form-group row">
                      <label for="status" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="status" class="custom-select" required="required">
                          @if($usuario->status) <option selected value="1">Activa</option> <option value="0">Desactivada</option>
                          @else <option value="1">Activa</option> <option selected value="0">Desactivada</option>@endif
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                        <label for="nivel" class="col-4 col-form-label">Nivel</label> 
                        <div class="col-8">
                          <select id="nivel" name="nivel" class="custom-select" required="required">
                            @if($usuario->nivel) <option selected value="1">Usuario</option> <option value="2">Administrador</option>
                            @else <option value="1">Usuario</option> <option selected value="2">Administrador</option>@endif 
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