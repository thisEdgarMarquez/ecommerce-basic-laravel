@extends('admin.layouts.app')
@section('content')
<div class="jumbotron text-center">
  <h1 class="text-uppercase">PRENDAS</h1>
  <a href="{{route('agregarPrenda')}}">
    <button class="btn btn-success btn-lg"> <i class="fa fa-plus"></i> Agregar</button>
  </a>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th>Nombre</th>
                        <th>Precio</th>
                        <th>Marca</th>
                        <th>Categoría</th>
                        <th>Género</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
            <th>Estado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          @foreach($prendas as $prenda)
          <tr data-id="{{$prenda->id}}">
                        <td>{{$prenda->nombre}}</td>
                        <td>{{$prenda->precio}}</td>
                        <td>{{$prenda->marca_pk['nombre']}}</td>
                        <td>{{$prenda->categoria_pk['nombre']}}</td>
                        <td>{{$prenda->genero_pk['nombre']}}</td>
                        <td>{{$prenda->descripcion}}</td>
                        <td>{{$prenda->cantidad}}</td>
            @if($prenda->status)
              <td>Activa</td>
            @else
              <td>Desactivada</td>
                        @endif
                        <td>
<<<<<<< HEAD
							<div class="btn-group btn-group-xs" role="group" aria-label="...">
								<a href="{{route('editarPrenda',['id' => $prenda->id])}}" class="btn btn-sm btn-info">
									Editar <i class="fas fa-pencil-alt"></i>
								</a>
								<a href="#" onClick="return confirmacion('¿Estás seguro de eliminar la Prenda?','{{route('eliminarPrenda')}}',{{$prenda->id}});" class="btn btn-sm btn-danger">
									Eliminar <i class="fas fa-trash "></i>
								</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div id="ajaxRespuesta"></div>
		</div>
	</div>
=======
              <div class="btn-group btn-group-xs btn-group-sm" role="group" aria-label="...">
                <button class="btn btn-info">
                  <a href="{{route('editarPrenda',['id' => $prenda->id])}}" class="btn btn-sm btn-info">
                    Editar <i class="fas fa-pencil-alt"></i>
                  </a>
                </button>
                <button class="btn btn-danger">
                  <a href="#" onClick="return confirmacion('¿Estás seguro de eliminar la Prenda?','{{route('eliminarPrenda')}}',{{$prenda->id}});" class="btn btn-sm btn-danger">
                    Eliminar <i class="fas fa-trash "></i>
                  </a>
                </button>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div id="ajaxRespuesta"></div>
    </div>
  </div>
>>>>>>> 5c17186685a2fda2cca356e77087d28c1938eeea
</div>
<div class="row">
  <div class="col-md-12">
    {{$prendas->render()}}
  </div>
</div>
@endsection