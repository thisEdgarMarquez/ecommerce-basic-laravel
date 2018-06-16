<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'esAdmin'],function(){
     //Generales
     Route::get('admin','AdminController@index')->name('admin');
    //Categoria
    Route::get('admin/categorias','CategoriaController@index')->name('verCategorias');
    Route::get('admin/categorias/agregar','CategoriaController@agregar')->name('agregarCategoria');
    Route::get('admin/categorias/editar/{id}','CategoriaController@editar')->name('editarCategoria')->where('id','[0-9]+');
    Route::post('admin/categorias/guardar','CategoriaController@guardar')->name('guardarCategoria');
    Route::post('admin/categorias/eliminar','CategoriaController@eliminar')->name('eliminarCategoria');
    Route::post('admin/categorias/actualizar','CategoriaController@actualizar')->name('actualizarCategoria');
    //Géneros
    Route::get('admin/generos','GeneroController@index')->name('verGeneros');
    Route::get('admin/generos/agregar','GeneroController@agregar')->name('agregarGenero');
    Route::get('admin/generos/editar/{id}','GeneroController@editar')->name('editarGenero')->where('id','[0-9]+');
    Route::post('admin/generos/crear','GeneroController@crear')->name('crearGenero');
    Route::post('admin/generos/eliminar','GeneroController@eliminar')->name('eliminarGenero');
    Route::post('admin/generos/actualizar','GeneroController@actualizar')->name('actualizarGenero');
    //Marcas
    Route::get('admin/marcas','MarcaController@index')->name('verMarcas');
    Route::get('admin/marcas/agregar','MarcaController@agregar')->name('agregarMarca');
    route::get('admin/marcas/editar/{id}','MarcaController@editar')->name('editarMarca')->where('id','[0-9]+');
    Route::post('admin/marcas/crear','MarcaController@crear')->name('crearMarca');
    Route::post('admin/marcas/actualizar','MarcaController@actualizar')->name('actualizarMarca');
    Route::post('admin/marcas/eliminar','MarcaController@eliminar')->name('eliminarMarca');
    //Tallas
    Route::get('admin/tallas','TallaController@index')->name('verTallas');
    Route::get('admin/tallas/agregar','TallaController@agregar')->name('agregarTalla');
    Route::get('admin/tallas/editar/{id}','TallaController@editar')->name('editarTalla')->where('id','[0-9]+');
    Route::post('admin/tallas/crear','TallaController@crear')->name('crearTalla');
    Route::post('admin/tallas/actualizar','TallaController@actualizar')->name('actualizarTalla');
    Route::post('admin/tallas/eliminar','TallaController@eliminar')->name('eliminarTalla');
    //Colores
    Route::get('admin/colores','ColorController@index')->name('verColores');
    Route::get('admin/colores/agregar','ColorController@agregar')->name('agregarColor');
    Route::get('admin/colores/editar/{id}','ColorController@editar')->name('editarColor')->where('id','[0-9]+');
    Route::post('admin/colores/crear','ColorController@crear')->name('crearColor');
    Route::post('admin/colores/actualizar','ColorController@actualizar')->name('actualizarColor');
    Route::post('admin/colores/eliminar','ColorController@eliminar')->name('eliminarColor');
    //Prendas
    Route::get('admin/prendas','PrendaController@index')->name('verPrendas');
    Route::get('admin/prendas/agregar','PrendaController@agregar')->name('agregarPrenda');
    Route::get('admin/prendas/editar/{id}','PrendaController@editar')->name('editarPrenda')->where('id','[0-9]+');
    Route::post('admin/prendas/crear','PrendaController@crear')->name('crearPrenda');
    Route::post('admin/prendas/actualizar','PrendaController@actualizar')->name('actualizarPrenda');
    Route::post('admin/prendas/eliminar','PrendaController@eliminar')->name('eliminarPrenda');
    //Proveedores
    Route::get('admin/proveedores','ProveedorController@index')->name('verProveedores');
    Route::get('admin/proveedores/agregar','ProveedorController@agregar')->name('agregarProveedor');
    Route::get('admin/proveedores/editar/{id}','ProveedorController@editar')->name('editarProveedor')->where('id','[0-9]+');
    Route::post('admin/proveedores/crear','ProveedorController@crear')->name('crearProveedor');
    Route::post('admin/proveedores/actualizar','ProveedorController@actualizar')->name('actualizarProveedor');
    Route::post('admin/proveedores/eliminar','ProveedorController@eliminar')->name('eliminarProveedor');
    //Usuarios
    Route::get('admin/usuarios','UsuarioController@index')->name('verUsuarios');
    Route::get('admin/usuarios/agregar','UsuarioController@agregar')->name('agregarUsuario');
    Route::get('admin/usuarios/editar/{id}','UsuarioController@editar')->name('editarUsuario')->where('id','[0-9]+');
    Route::post('admin/usuarios/crear','UsuarioController@crear')->name('crearUsuario');
    Route::post('admin/usuarios/actualizar','UsuarioController@actualizar')->name('actualizarUsuario');
    Route::post('admin/usuarios/eliminar','UsuarioController@eliminar')->name('eliminarUsuario');
    //Entradas
    Route::get('admin/entradas','EntradaController@index')->name('verEntradas');
    Route::get('admin/entradas/agregar','EntradaController@agregar')->name('agregarEntrada');
    Route::get('admin/entradas/ver/{id}','EntradaController@getEntradaDetalle')->name('entradaDetalles')->where('id','[0-9]+');
    Route::get('admin/entradas/gettallas','EntradaController@gettallas')->name('gettallas');
    Route::post('admin/entradas/crear','EntradaController@crear')->name('crearEntrada');
    Route::get('admin/entradas/editar/{id}','EntradaController@editar')->name('editarEntrada')->where('id','[0-9]+');
    Route::post('admin/entradas/actualizar','EntradaController@actualizar')->name('actualizarEntrada');
    Route::post('admin/entradas/eliminar','EntradaController@eliminar')->name('eliminarEntrada');
    //Facturas
    Route::get('admin/facturas','FacturaController@index')->name('verFacturas');
    Route::get('admin/facturas/ver/{id}','FacturaController@detalles')->name('detallesFactura')->where('id','[0-9]+');
    //Pagos
    Route::get('admin/pagos','PagoController@index')->name('verPagos');
    Route::get('admin/pagos/agregar','PagoController@agregar')->name('agregarPago');
    Route::post('admin/pagos/crear','PagoController@crear')->name('crearPago');
    Route::get('admin/pagos/editar/{id}','PagoController@editar')->name('editarPago')->where('id','[0-9]+');
    Route::post('admin/pagos/actualizar','PagoController@actualizar')->name('actualizarPago');
    Route::post('admin/pagos/eliminar','PagoController@eliminar')->name('eliminarPago');
    Route::post('admin/pagos/aprobar','PagoController@aprobar')->name('aprobarPago');
    Route::post('admin/pagos/rechazar','PagoController@rechazar')->name('rechazarPago');
});

//Home 
Route::group(['middleware' => 'auth'],function(){
    Route::get('perfil','UsuarioController@miperfil')->name('miperfil');
    Route::post('perfil/editar','UsuarioController@editarPerfil')->name('editarPerfil');

    //Carro
    Route::get('carro','CarroController@index')->name('carro');
    Route::post('carro/agregar','CarroController@agregar')->name('carroAgregar');
    Route::post('carro/editar','CarroController@editar')->name('carroEditar');
    Route::get('carro/eliminar/{id}','CarroController@eliminar')->name('carroEliminar')->where('id','[0-9]+');
    Route::get('carro/comprar','CarroController@comprar')->name('carroComprar');
    Route::get('carro/pagar/{id}','PagoController@pagarGET')->name('pagarGET')->where('id','[0-9]+');
    Route::post('carro/pagar','PagoController@pagarPOST')->name('pagarPOST');

    //PDF
    Route::get('pdf/factura/{id}','FacturaController@pdf')->name('pdfFactura')->where('id','[0-9]+');
});
Route::get('/','InicioController@index')->name('inicio');
//Detalles Prenda
Route::get('detalles-prenda/{id}','PrendaController@detalles')->name('detallesPrenda')->where('id','[0-9]+');
//Categoria
Route::get('categoria/{id}','CategoriaController@ver')->name('verCategoria')->where('id','[0-9]+');
Auth::routes();