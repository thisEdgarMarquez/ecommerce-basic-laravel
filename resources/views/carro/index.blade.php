@extends('layouts.app')
@section('content')
@if(count(\Session::get('carro')) > 0)
<div class="container">
        {{csrf_field()}}
	<table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:40%">Producto</th>
                <th style="width:10%">Precio</th>
                <th style="width:5%">Cantidad</th>
                <th style="width:10%">Talla</th>
                <th style="width:20%" class="text-center">Subtotal</th>
                <th style="width:10%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach(\Session::get('carro') as $key=>$item)
            <tr>
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3 hidden-xs"><img src="{{$item['img']}}" alt="{{$item['nombre']}}" class="img-responsive" width="100"/></div>
                        <div class="col-sm-9">
                            <h4 class="nomargin">{{$item['nombre']}}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">{{$item['precio']}} BsF</td>
                <td data-th="Quantity">
                    <input name="cantidad-{{$key}}" type="number" class="form-control text-center" value="{{$item['cantidad']}}" min=1>
                </td>
                <td data-th="Talla">
                @foreach($tallas as $talla)
                {{$talla->id == $item['id_talla'] ? $talla->medida : ''}}
                @endforeach
                </td>
                <td data-th="Subtotal" class="text-center">{{$item['precio']}} BsF</td>
                <td class="actions">
                    <button onclick="editarCarro({{$key}},'{{route('carroEditar')}}')" class="btn btn-info btn-sm"><i class="fa fa-sync"></i></button>
                    <a href="{{route('carroEliminar',$key)}}"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>								
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><a href="/" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continuar Comprando</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td></td>
                <td class="hidden-xs text-center"><strong>Total {{$total}} BsF</strong></td>
                <td><a href="#" class="btn btn-success btn-block">Pagar <i class="fa fa-angle-right"></i></a></td>
            </tr>
        </tfoot>
    </table>
    @else
    <div class="alert alert-danger" style="margin-top:50px;text-align: center;">
        <ul>
           <li style="list-style:none;text-align:center"><h3>Lo sentimos, el carro se encuentra vacio</h3></li>
        </ul>
        <span><small><a href="/">Regresar</a></small></span>
    </div>
    </div>
    @endif
@endsection
