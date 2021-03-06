@extends('layouts.app')
@section('content')
    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Categorías</h1>
          <div class="list-group">
          @foreach($categorias as $categoria)
            <a href="{{route('verCategoria',$categoria->id)}}" class="list-group-item">{{$categoria->nombre}}</a>
          @endforeach
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="{{asset('img/slide1.jpeg')}}" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="{{asset('img/slide2.jpeg')}}" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="{{asset('img/slide3.jpeg')}}" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
            @foreach($prendas as $prenda)
            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <a href="{{route('detallesPrenda',['id' => $prenda->id])}}" >
                  <img style="min-height: 253px;max-height: 253px;" class="card-img-top" src="{{asset('uploads/'.(($prenda['img1'] != NULL)?$prenda['img1']:'default.png'))}}" alt="">
                </a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="{{route('detallesPrenda',['id' => $prenda->id])}}" >{{$prenda->nombre}}</a>
                  </h4>
                  <h5>{{$prenda->precio}} BsF</h5>
                  <p class="card-text">{{$prenda->descripcion}}</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">{{$prenda->categoria_pk->nombre}}</small>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection
