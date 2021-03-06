@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="jumbotron text-center">
        <h1 class="text-uppercase">AGREGAR PRENDA</h1>
    </div>

    <div>
            <form method="POST" action="{{route('crearPrenda')}}" id="crea-prenda" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="form-group row">
                      <label for="nombre" class="col-4 col-form-label">Nombre</label> 
                      <div class="col-8">
                        <input id="nombre" name="nombre" class="form-control here" required="required" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="precio" class="col-4 col-form-label">Precio</label> 
                        <div class="col-8">
                          <input id="precio" name="precio" class="form-control here" required="required" type="number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idmarca" class="col-4 col-form-label">Marca</label> 
                        <div class="col-8">
                          <select name="idmarca" required class="custom-select">
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idcategoria" class="col-4 col-form-label">Categoria</label> 
                        <div class="col-8">
                            <select name="idcategoria" required class="custom-select">
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idgenero" class="col-4 col-form-label">Genero</label> 
                        <div class="col-8">
                            <select name="idgenero" class="custom-select" required>
                                @foreach($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="descripcion" class="col-4 col-form-label">Descripción</label> 
                      <div class="col-8">
                        <textarea style=" text-transform:capitalize;" id="descripcion" name="descripcion" cols="40" rows="5" class="form-control" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="status" class="custom-select" required="required">
                          <option value="1">Activa</option>
                          <option value="0">Desactivada</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-4 col-form-label">Imágenes</label> 
                      <div class="col-8">
                        <input class="form-control" type="file" name="imagenes[img1]" accept="image/*">
                        <input class="form-control" type="file" name="imagenes[img2]" accept="image/*">
                        <input class="form-control" type="file" name="imagenes[img3]" accept="image/*">
                      </div>
                    </div> 
                    <div class="form-group row">
                      <div class="offset-4 col-8">
                        <button name="submit" type="submit" id="submit-agregar-prenda" class="btn btn-primary">Submit</button>
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