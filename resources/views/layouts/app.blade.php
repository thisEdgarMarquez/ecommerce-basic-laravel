<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href={{asset('css/bootstrap.min.css')}} rel="stylesheet"/>
    <link href={{asset('fontawesome/css/fontawesome-all.css')}} rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
        @guest @else<li class="nav-item"><span style="padding-top:20px;color:white;">Bienvenido {{Auth::user()->nombre}}</span></li>@endguest
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{route('inicio')}}">Inicio
              </a>
            </li>
            @guest
            <!--Login y Registro -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('register')}}">Registrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('login')}}">Ingresar</a>
            </li>
            @else
            @if(Auth::user()->nivel == 2)
            <li class="nav-item"><a class="nav-link" ref="{{route('carro')}}" href="{{route('admin')}}">Admin</a></li>
            @endif
            <li class="nav-item"><a class="nav-link" ref="{{route('carro')}}" href="{{route('carro')}}"><i class="fa fa-shopping-bag"></i> Carro</a></li>
            <li class="nav-item"><a class="nav-link" ref="{{route('miperfil')}}" href="{{route('miperfil')}}">Perfil</a></li>
            <li class="nav-item">
                <a class="nav-link" ref="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">Salir</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
            </form>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
        <div class="container">
            @yield('content')
    </div>
</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/funciones.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
