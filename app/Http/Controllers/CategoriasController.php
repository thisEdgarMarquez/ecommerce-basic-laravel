<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorias;

class CategoriasController extends Controller
{
    public function index(){
        $categorias = Categorias::all();
        return view('admin/categorias/index',['categorias' => $categorias]);
    }
    public function agregar(){
        return view('admin/categorias/agregar');
    }
    public function guardar(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:categorias|max:255',
            'descripcion' => 'required',
            'estado' => 'required|boolean'
        ]);
        $categoria = Categorias::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'estado' => $request->get('estado')
        ]);
        $msj = $categoria ? 'La categoria fue creada con exito.' : 'Lo sentimos, ocurrio un error en el proceso de creación de la categoria.';
        return redirect()->route('agregarCategorias')->with('msj',$msj);
    }
}
