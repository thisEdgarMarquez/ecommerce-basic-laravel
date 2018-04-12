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
});
Route::get('/', function () {
    return view('home');
})->name('inicio');

Auth::routes();