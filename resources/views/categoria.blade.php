@extends('layouts/app')
@section('content')
<div class="col-md-12">
    <div class="row">
    @if(count($prendas) > 0)
        @foreach($prendas as $prenda)
        <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <a href="{{route('detallesPrenda',['id' => $prenda->id])}}" >
                    <img style="min-height: 253px;max-height: 253px;" class="card-img-top" src="{{asset('uploads/'.(($prenda->img1 != NULL)?$prenda->img1:'default.png'))}}" alt="">
                </a>
                <div class="card-body">
                    <h4 class="card-title">
                    <a href="{{route('detallesPrenda',['id' => $prenda->id])}}" >{{$prenda->nombre}}</a>
                    </h4>
                    <h5>{{$prenda->precio}} BsF</h5>
                    <p class="card-text">{{$prenda->descripcion}}</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">{{$categoria[0]['nombre']}}</small>
                </div>
                </div>
            </div>
        @endforeach
    @else
    <div class="col-md-12">
    <div style="margin-top:50px" class="alert alert-info text-center">
            <h3>La categoria no posee articulos actualmente.</h3><br>
            <a href="/">Volver</a>
        </div>
    </div>
    @endif
    </div>
    <div class="row">
        {{$prendas->render()}}
    </div>
</div>
@endsection