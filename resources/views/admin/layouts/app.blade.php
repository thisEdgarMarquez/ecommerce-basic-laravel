<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href={{asset('css/bootstrap.min.css')}} rel="stylesheet">
    <link href={{asset('css/estilo.css')}} rel="stylesheet">
    <link href={{asset('fontawesome/css/fontawesome-all.css')}} rel="stylesheet">
    <link href="{{asset('colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/funciones.js')}}"></script>
<script src="{{asset('colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#hexadecimalInput').colorpicker({
        useHashPrefix: false,
        format:'hexademcimal'
    });

});
</script>