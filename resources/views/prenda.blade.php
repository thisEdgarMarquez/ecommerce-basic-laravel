@extends('layouts.app')
@section('content')

<style>
.gallery-wrap, .gallery-wrap img {
  max-width: 100%;
}
 .gallery {
   overflow: hidden;
 } 
 .gallery__hero {
   overflow: hidden;
   position: relative;
   padding: 2em;
   margin: 0 0 0.3333333333em;
   background: #fff;
 } 
 .gallery__thumbs {
   text-align: center;
   background: #fff;
 }
 .gallery__thumbs a {
   display: inline-block;
   width: 20%;
   padding: 0.5em;
   opacity: 0.75;
   transition: opacity 0.3s cubic-bezier(0.455, 0.03, 0.515, 0.955);
 }
 .gallery__thumbs a:hover {
   opacity: 1;
 }
 .gallery__thumbs a.is-active {
   opacity: 0.2;
 }
</style>
@foreach($prenda as $item)
<form id="form-detalles-prenda" action="{{route('carroAgregar')}}" method="POST">
{{csrf_field()}}
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
			<article class="gallery-wrap"> 

				<!-- Gallery -->
				<div id="js-gallery" class="gallery">

				<!--Gallery Hero-->
				<div class="gallery__hero">
					<img src="{{asset('/uploads/'.(($item->img1 != NULL)?$item->img1:'default.png'))}}">
				</div>
				<!--Gallery Hero-->

				<!--Gallery Thumbs-->
				<div class="gallery__thumbs">
						<a href="{{asset('/uploads/'.(($item->img1 != NULL)?$item->img1:'default.png'))}}" data-gallery="thumb" class="is-active">
							<img src="{{asset('/uploads/'.(($item->img1 != NULL)?$item->img1:'default.png'))}}">
							<input type="hidden" name="img" value="{{asset('/uploads/'.(($item->img1 != NULL)?$item->img1:'default.png'))}}" />						</a>
						<a href="{{asset('/uploads/'.(($item->img2 != NULL)?$item->img2:'default.png'))}}" data-gallery="thumb">
							<img src="{{asset('/uploads/'.(($item->img2 != NULL)?$item->img2:'default.png'))}}">
						</a>
						<a href="{{asset('/uploads/'.(($item->img3 != NULL)?$item->img3:'default.png'))}}" data-gallery="thumb">
							<img src="{{asset('/uploads/'.(($item->img3 != NULL)?$item->img3:'default.png'))}}">
						</a>
				</div>
				<!--Gallery Thumbs-->

				</div><!--.gallery-->
				<!-- Gallery -->

			</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">

		<article class="card-body p-5">
				<h3 class="title mb-3">{{ $item->nombre }}</h3>

			<p class="price-detail-wrap"> 
				<span class="price h3 text-warning"> 
					<span class="currency">Bs. </span><span class="num">{{ $item->precio }}</span>
				</span> 
				<span>c/u</span> 
			</p> <!-- price-detail-wrap .// -->
			<dl class="item-property">
				<dt>Descripción</dt>
				<dd><p>{{ $item->descripcion }}</p></dd>
			</dl>
			<dl class="param param-feature">
				<dt>Marca</dt>
				<dd>{{ $item->marca_pk['nombre'] }}</dd>
			</dl>  <!-- item-property-hor .// -->
			<dl class="param param-feature">
				<dt>Género</dt>
				<dd>{{ $item->genero_pk['nombre'] }}</dd>
			</dl>  <!-- item-property-hor .// -->
			<dl class="param param-feature">
				<dt>Colores</dt>
				<dd>
					@if(count($tallas) > 0)
					@else
					<label>No existe inventario disponible</label>
					@endif
				</dd>
			</dl>  <!-- item-property-hor .// -->

			<hr>
				<div class="row">
					<div class="col-sm-7">
						<dl class="param param-inline">
								<dt>Tallas</dt>
								<dd>
								@if(count($tallas) > 0)
									@foreach($tallas as $talla)
										<label class="form-check form-check-inline" title="Disponible: {{$talla['cantidad']}}">
											<input class="form-check-input" {{($talla['cantidad'] == 0)?'disabled':''}} type="radio" name="talla" id="inlineRadio2" value="{{$talla['id']}}" data-maxcant="{{$talla['cantidad']}}">										<input type="hidden" name="idtalla" value="{{$talla['id']}}" />
											<span class="form-check-label">{{$talla['medida']}}</span>
										</label>
									@endforeach
								@else
								<label>No existe inventario disponibe</label>
								@endif
								</dd>
						</dl>  <!-- item-property .// -->
					</div> <!-- col.// -->
					<div class="col-sm-5">
						<dl class="param param-inline">
							<dt>Cantidad</dt>
							<dd>
								@if(count($tallas) > 0)
								<input name="cantidad" type="number" min="1" value="1" class="form-control form-control-sm">
								 @else
								 <input name="cantidad" type="number" min="0" value="0" class="form-control  form-control-sm" disabled>
 								@endif
							</dd>
						</dl>  <!-- item-property .// -->
					</div> <!-- col.// -->
				</div> <!-- row.// -->
				<input type="hidden" name="id" value={{$item->id}} />
				<input type="hidden" name="precio" value={{$item->precio}} />
				<input type="hidden" name="nombre" value="{{$item->nombre}}" />
				<hr>
				@if(count($tallas) > 0)
				 @guest
				 <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Debe iniciar sesión antes de comprar">
						<input disabled type="submit" class="btn btn-lg btn-disabled text-uppercase " value="Comprar Ahora"  />
					</span>
					<span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Debe iniciar sesión antes de comprar">
						<a href="#" class="btn btn-lg btn-outline-primary text-uppercase disabled"> <i class="fas fa-shopping-cart"></i> agregar al carrito </a>
					</span>
					@else
					<input type="submit" class="btn btn-lg btn-primary text-uppercase " value="Comprar Ahora"  />
					<a href="#" class="btn btn-lg btn-outline-primary text-uppercase	"> <i class="fas fa-shopping-cart"></i> agregar al carrito </a>
						@endguest
					@endif
		</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->

</div>
<!--container.//-->

</form>
@endforeach
@endsection