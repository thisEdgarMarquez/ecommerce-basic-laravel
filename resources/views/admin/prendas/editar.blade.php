@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="text-center">
        <h3>Editar prenda</h3>
    </div>
    <div>
            <form method="POST" action="{{route('actualizarPrenda')}}">
                {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$prenda->id}}"/>
                    <div class="form-group row">
                      <label for="nombre" class="col-4 col-form-label">Nombre</label> 
                      <div class="col-8">
                      <input id="nombre" name="nombre" class="form-control here" required="required" type="text" value="{{$prenda->nombre}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="precio" class="col-4 col-form-label">Precio</label> 
                        <div class="col-8">
                        <input id="precio" name="precio" class="form-control here" required="required" type="number" value="{{$prenda->precio}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idmarca" class="col-4 col-form-label">Marca</label> 
                        <div class="col-8">
                          <select name="idmarca" required class="custom-select">
                            @foreach($marcas as $marca)
                                @if($marca->id == $prenda->idmarca)
                                    <option selected value="{{$marca->id}}">{{$marca->nombre}}</option>
                                @else
                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                @endif;
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idcategoria" class="col-4 col-form-label">Categoria</label> 
                        <div class="col-8">
                            <select name="idcategoria" required class="custom-select">
                                @foreach($categorias as $categoria)
                                    @if($categoria->id == $prenda->idcategoria)
                                        <option selected value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @else
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idgenero" class="col-4 col-form-label">Genero</label> 
                        <div class="col-8">
                            <select name="idgenero" class="custom-select" required>
                                @foreach($generos as $genero)
                                    @if($genero->id == $prenda->idgenero)
                                        <option selected value="{{$genero->id}}">{{$genero->nombre}}</option>
                                    @else
                                        <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="descripcion" class="col-4 col-form-label">Descripción</label> 
                      <div class="col-8">
                      <textarea id="descripcion" name="descripcion" cols="40" rows="5" class="form-control" required="required">{{$prenda->descripcion}}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                            <select id="estado" name="status" class="custom-select" required="required">
                                @if($prenda->status == 1)
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