@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12">
        <div class="alert alert-primary" style="margin-top:50px;text-align: center;">
            <ul>
                <li style="list-style:none;text-align:center"><h3>{{$result}}</h3></li>
            </ul>
            <span><small><a href="/">Regresar</a></small></span>
        </div>
    </div>
</div>
@endsection