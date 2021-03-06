@extends('layouts.app')
@section('content')
    <div class="row m-y-2">
        <div class="col-lg-12 push-lg-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Perfil</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Editar</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#facturas" data-toggle="tab" class="nav-link">Facturas</a>
                </li>
            </ul>
            <div class="tab-content p-b-3">
                <div class="tab-pane @if (session('msj')) active @endif" id="facturas">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fecha</th>
                                            <th>Monto</th>						
                                            <th>Estado</th>
                                            <th>Pago</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $idpagos = array(); @endphp
                                        @foreach($facturas as $factura)
                                        @php $btnstatus = null; @endphp
                                        <tr data-id="{{$factura->id}}">
                                            <td>{{$factura->id}}</td>
                                            <td>{{ $factura->fecha }}</td>
                                            <td>{{$factura->monto}} BsF</td>
                                            <td>@if($factura->status) Despachada @else Sin despachar @endif</td>
                                            <td>
                                            @foreach($factura->pagos_pk as $pago)
                                                @if($pago->idfactura == $factura->id)
                                                    @switch($pago->status)
                                                        @case('0')
                                                        En espera
                                                        @php $btnstatus = false; @endphp
                                                        @break
                                                        @case('1')
                                                        Aprobado
                                                        @php $btnstatus = false; @endphp
                                                        @break
                                                        @case('2')
                                                        Rechazado
                                                        @php $btnstatus = false; @endphp
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                    @php array_push($idpagos,$factura->id); @endphp
                                                @endif
                                            @endforeach
                                            @if(!in_array($factura->id,$idpagos))
                                            Sin pago
                                            @php $btnstatus = true; @endphp
                                            @endif
                                            </td>
                                            <td>
                                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                @if($btnstatus)
                                                    <a href="{{route('pagarGET',$factura->id)}}" class="btn btn-sm btn-primary">
                                                        Pagar <i class="fas fa-money-bill-alt "></i>
                                                    </a>
                                                @else
                                                <a href="" class="btn btn-sm btn-primary disabled">
                                                        Pagar <i class="fas fa-money-bill-alt "></i>
                                                </a>
                                                @endif
                                                <a href="{{route('pdfFactura',$factura->id)}}" class="btn btn-sm btn-danger">
                                                    Ver factura <i class="fas fa-file-pdf "></i>
                                                </a>
                                            </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                    {{$facturas->render()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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