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
    Route::get('admin/categorias/editar/{id}','CategoriaController@editar')->name('editarCategoria')->where('id','[1-9]+');
    Route::post('admin/categorias/guardar','CategoriaController@guardar')->name('guardarCategoria');
    Route::post('admin/categorias/eliminar','CategoriaController@eliminar')->name('eliminarCategoria');
    Route::post('admin/categorias/actualizar','CategoriaController@actualizar')->name('actualizarCategoria');
    //Géneros
    Route::get('admin/generos','GeneroController@index')->name('verGeneros');
    Route::get('admin/generos/agregar','GeneroController@agregar')->name('agregarGenero');
    Route::get('admin/generos/editar/{id}','GeneroController@editar')->name('editarGenero')->where('id','[1-9]+');
    Route::post('admin/generos/crear','GeneroController@crear')->name('crearGenero');
    Route::post('admin/generos/eliminar','GeneroController@eliminar')->name('eliminarGenero');
    Route::post('admin/generos/actualizar','GeneroController@actualizar')->name('actualizarGenero');
    //Marcas
    Route::get('admin/marcas','MarcaController@index')->name('verMarcas');
    Route::get('admin/marcas/agregar','MarcaController@agregar')->name('agregarMarca');
    route::get('admin/marcas/editar/{id}','MarcaController@editar')->name('editarMarca')->where('id','[1-9]+');
    Route::post('admin/marcas/crear','MarcaController@crear')->name('crearMarca');
    Route::post('admin/marcas/actualizar','MarcaController@actualizar')->name('actualizarMarca');
    Route::post('admin/marcas/eliminar','MarcaController@eliminar')->name('eliminarMarca');
    //Tallas
    Route::get('admin/tallas','TallaController@index')->name('verTallas');
    Route::get('admin/tallas/agregar','TallaController@agregar')->name('agregarTalla');
    Route::get('admin/tallas/editar/{id}','TallaController@editar')->name('editarTalla')->where('id','[1-9]+');
    Route::post('admin/tallas/crear','TallaController@crear')->name('crearTalla');
    Route::post('admin/tallas/actualizar','TallaController@actualizar')->name('actualizarTalla');
    Route::post('admin/tallas/eliminar','TallaController@eliminar')->name('eliminarTalla');
    //Colores
    Route::get('admin/colores','ColorController@index')->name('verColores');
    Route::get('admin/colores/agregar','ColorController@agregar')->name('agregarColor');
    Route::get('admin/colores/editar/{id}','ColorController@editar')->name('editarColor')->where('id','[1-9]+');
    Route::post('admin/colores/crear','ColorController@crear')->name('crearColor');
    Route::post('admin/colores/actualizar','ColorController@actualizar')->name('actualizarColor');
    Route::post('admin/colores/eliminar','ColorController@eliminar')->name('eliminarColor');
    //Prendas
    Route::get('admin/prendas','PrendaController@index')->name('verPrendas');
    Route::get('admin/prendas/agregar','PrendaController@agregar')->name('agregarPrenda');
    Route::get('admin/prendas/editar/{id}','PrendaController@editar')->name('editarPrenda')->where('id','[1-9]+');
    Route::post('admin/prendas/crear','PrendaController@crear')->name('crearPrenda');
    Route::post('admin/prendas/actualizar','PrendaController@actualizar')->name('actualizarPrenda');
    Route::post('admin/prendas/eliminar','PrendaController@eliminar')->name('eliminarPrenda');
});
Route::get('/', function (App\Categoria $categorias) {
    return view('home',['categorias' => $categorias->all()]);
})->name('inicio');

Auth::routes();