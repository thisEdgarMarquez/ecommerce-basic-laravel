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
    //Categorias
    Route::get('admin/categorias','CategoriasController@index')->name('verCategorias');
    Route::get('admin/categorias/agregar','CategoriasController@agregar')->name('agregarCategorias');
    route::post('admin/categorias/guardar','CategoriasController@guardar')->name('guardarCategorias');
    //Generales
    Route::get('admin','AdminController@index')->name('admin');
});
Route::get('/', function () {
    return view('home');
})->name('inicio');

Auth::routes();