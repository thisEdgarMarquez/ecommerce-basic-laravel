@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="jumbotron text-center">
        <h1 class="text-uppercase">EDITAR MARCA</h1>
    </div>
    <div>
            <form method="POST" action="{{route('actualizarMarca')}}">
                {{csrf_field()}}
                    <input type="hidden" name="id" value={{$marca->id}} />
                    <div class="form-group row">
                      <label for="nombre" class="col-4 col-form-label">Nombre</label> 
                      <div class="col-8">
                        <input id="nombre" name="nombre" class="form-control here" required="required" type="text" value="{{$marca->nombre}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="descripcion" class="col-4 col-form-label">Descripción</label> 
                      <div class="col-8">
                        <textarea id="descripcion" name="descripcion" cols="40" rows="5" class="form-control" required="required">{{$marca->descripcion}}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="status" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="status" class="custom-select" required="required">
                        @if($marca->status == 1)
                            <option value="1" selected>Activa</option>
                            <option value="0">Desactivada</option>
                        @else
                            <option value="1" selected>Activa</option>
                            <option value="0" selected>Desactivada</option>
                        @endif
                        </select>
                      </div>
                    </div> 
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="submit" type="submit" class="btn btn-primary">Actualizar</button>
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