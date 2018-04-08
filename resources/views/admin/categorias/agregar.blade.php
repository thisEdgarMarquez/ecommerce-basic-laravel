@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="text-center">
        <h3>Agregar categoria</h3>
    </div>
    <div>
            <form method="POST" action="{{route('guardarCategorias')}}">
                {{csrf_field()}}
                    <div class="form-group row">
                      <label for="nombre" class="col-4 col-form-label">Nombre</label> 
                      <div class="col-8">
                        <input id="nombre" name="nombre" class="form-control here" required="required" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="descripcion" class="col-4 col-form-label">Descripción</label> 
                      <div class="col-8">
                        <textarea id="descripcion" name="descripcion" cols="40" rows="5" class="form-control" required="required"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="estado" class="col-4 col-form-label">Estado</label> 
                      <div class="col-8">
                        <select id="estado" name="estado" class="custom-select" required="required">
                          <option value="0">Activa</option>
                          <option value="1">Desactivada</option>
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