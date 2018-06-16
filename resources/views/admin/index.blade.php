@extends('admin.layouts.app')
@section('content')
<h3 class="text-center">Bienvenido al panel administrado, {{Auth::user()->nombre}}</h3>
@endsection