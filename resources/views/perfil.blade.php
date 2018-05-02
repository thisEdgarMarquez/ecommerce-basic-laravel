@extends('layouts.app')
@section('content')
    <div class="row m-y-2">
        <div class="col-lg-8 push-lg-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Perfil</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Editar</a>
                </li>
            </ul>
            <div class="tab-content p-b-3">
                <div class="tab-pane @if (!session('msj')) active @endif" id="profile">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                                <div class="col-lg-9">
                                    <span>{{$usuario->nombre}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Apellido</label>
                                <div class="col-lg-9">
                                    <span>{{$usuario->apellido}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Correo Electronico</label>
                                <div class="col-lg-9">
                                    <span>{{$usuario->email}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Cedula</label>
                                    <div class="col-lg-9">
                                        <span>@if($usuario->cedula){{$usuario->cedula}}@else No posee @endif</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">RIF</label>
                                        <div class="col-lg-9">
                                            <span>@if($usuario->rif){{$usuario->rif}}@else No posee @endif</span>
                                        </div>
                                    </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Telefono 1</label>
                                <div class="col-lg-9">
                                    <span>{{$usuario->telefono1}}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Telefono 2</label>
                                <div class="col-lg-9">
                                <span>@if($usuario->telefono2){{$usuario->telefono2}}@else No posee @endif</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Dirección</label>
                                <div class="col-lg-9">
                                    <span>{{$usuario->direccion}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                <div class="tab-pane @if (session('msj')) active @endif" id="edit">
                    <form role="form" method="POST" action="{{route('editarPerfil')}}">
                            {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Nombre</label>
                            <div class="col-lg-9">
                                <input name="nombre" class="form-control" type="text" value="{{$usuario->nombre}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Apellido</label>
                            <div class="col-lg-9">
                                <input name="apellido" class="form-control" type="text" value="{{$usuario->apellido}}">
                            </div>
                        </div>
                       <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Correo Electrónico</label>
                            <div class="col-lg-9">
                                <input name="email" class="form-control" type="email" value="{{$usuario->email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Cedula</label>
                                <div class="col-lg-9">
                                    <input name="cedula" class="form-control" type="number" maxlength="8" min="0" value="{{$usuario->cedula}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">RIF </label>
                                    <div class="col-lg-9">
                                        <input name="rif" class="form-control" type="text" value="{{$usuario->rif}}">
                                    </div>
                                </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Telefono 1</label>
                            <div class="col-lg-9">
                                <input name="telefono1" class="form-control" type="number" min="0" value="{{$usuario->telefono1}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Telefono 2</label>
                            <div class="col-lg-9">
                                <input min="0" name="telefono2" class="form-control" type="number" value="{{$usuario->telefono2}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Dirección</label>
                            <div class="col-lg-9">
                                <textarea name="direccion" class="form-control">{{$usuario->direccion}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Contraseña</label>
                            <div class="col-lg-9">
                                <input name="password" class="form-control" type="password" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Repetir Contraseña</label>
                            <div class="col-lg-9">
                                <input class="form-control" type="password_confirmation" value="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <input type="submit" class="btn btn-success" value="Guardar Cambios">
                                <input type="reset" class="btn btn-primary" value="Limpiar">
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
        </div>
    </div>
<hr>
@endsection