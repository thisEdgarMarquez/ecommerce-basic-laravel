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
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
<article class="gallery-wrap"> 

<!-- Gallery -->
<div id="js-gallery" class="gallery">

<!--Gallery Hero-->
<div class="gallery__hero">
  <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-01.jpg">
</div>
<!--Gallery Hero-->

<!--Gallery Thumbs-->
<div class="gallery__thumbs">
    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-01.jpg" data-gallery="thumb" class="is-active">
      <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-01.jpg">
    </a>
    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-02.jpg" data-gallery="thumb">
      <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-02.jpg">
    </a>
    <a href="https://public-619e3.firebaseapp.com/Product-Gallery/products/normal/product-01_view-03.jpg" data-gallery="thumb">
      <img src="https://public-619e3.firebaseapp.com/Product-Gallery/products/thumb/product-01_view-03.jpg">
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
  <dd>{{ 'aqui los colores' }}</dd>
</dl>  <!-- item-property-hor .// -->

<hr>
	<div class="row">
		<div class="col-sm-7">
			<dl class="param param-inline">
				  <dt>Tallas</dt>
				  <dd>
					@foreach($item->prendastallas_pk as $tallaPrenda)
				  	<label class="form-check form-check-inline">
						@if($tallaPrenda->cantidad == 0)
					  <input class="form-check-input" disabled type="radio" name="inlineRadioOptions" id="inlineRadio2" value="{{$tallaPrenda->id}}">
						@else
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"  value="{{$tallaPrenda->id}}">
 						@endif
						@foreach($tallas as $talla)
						 <span class="form-check-label">
 								@if($talla->id == $tallaPrenda->idtalla)
								 {{$talla->medida}}
								@endif
						@endforeach
						</span>
					</label>
					@endforeach
				  </dd>
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
		<div class="col-sm-5">
			<dl class="param param-inline">
			  <dt>Cantidad</dt>
			  <dd>
				@if($item->cantidad == 0)
			  	<input name="cantidad" type="number" disabled min="1" class="form-control form-control-sm">
				@else
					<input name="cantidad" type="number" min="1" class="form-control form-control-sm" value="1">
				@endif
			  </dd>
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
	</div> <!-- row.// -->
	<hr>
	@if($item->cantidad == 0)
	<a href="#" class="btn btn-lg btn-primary text-uppercase disabled"> comprar ahora </a>
	<a href="#" class="btn btn-lg btn-outline-primary text-uppercase disabled"> <i class="fas fa-shopping-cart"></i> agregar al carrito </a>
	@else 
	<a href="#" class="btn btn-lg btn-primary text-uppercase"> comprar ahora </a>
	<a href="#" class="btn btn-lg btn-outline-primary text-uppercase"> <i class="fas fa-shopping-cart"></i> agregar al carrito </a>
	@endif
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->


</div>
<!--container.//-->
@endforeach
@endsection