@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="jumbotron text-center">
        <h1 class="text-uppercase">AGREGAR TALLA</h1>
    </div>
    <div>
            <form method="POST" action="{{route('crearTalla')}}">
                {{csrf_field()}}
                    <div class="form-group row">
                      <label for="medida" class="col-4 col-form-label">Medida</label> 
                      <div class="col-8">
                        <input id="medida" name="medida" class="form-control here" required="required" type="text">
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