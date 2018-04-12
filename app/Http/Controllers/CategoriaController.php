<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::all();
        return view('admin/categorias/index',['categorias' => $categorias]);
    }
    public function agregar(){
        return view('admin/categorias/agregar');
    }
    public function guardar(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:categorias|max:255',
            'descripcion' => 'string|required',
            'estado' => 'required|boolean'
        ]);
        $categoria = Categoria::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'status' => $request->get('estado')
        ]);
        $msj = $categoria ? 'La categoria fue creada con exito.' : 'Lo sentimos, ocurrio un error en el proceso de creación de la categoria.';
        return redirect()->route('agregarCategoria')->with('msj',$msj);
    }
    public function eliminar(Request $request){
        $deleted = Categoria::destroy($request->get('id'));
        $msj = $deleted ? 'La categoria fue eliminada con exito.' : 'Lo sentimos, ocurrio un error en el proceso de eliminación de la categoria.';
        return response()->json(['error'=>false,'msj' => $msj]);
    }
    public function actualizar(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:categorias|max:255',
            'descripcion' => 'string|required',
            'estado' => 'required|boolean'
        ]);
    }
    public function editar(Request $request){
        return view('admin/categorias/editar')->with('categoria',Categoria::findOrFail($request->segment(4)));
    }
}
