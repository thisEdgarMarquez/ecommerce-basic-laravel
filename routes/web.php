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
});
Route::get('/', function (App\Categoria $categorias) {
    return view('home',['categorias' => $categorias->all()]);
})->name('inicio');

Auth::routes();