<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Categoria;

class CategoriaController extends Controller
{
    public function index(){
        $categorias = Categoria::paginate(10);
        return view('admin/categorias/index',['categorias' => $categorias]);
    }
    public function agregar(){
        return view('admin/categorias/agregar');
    }
    public function guardar(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:categorias|max:255',
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $categoria = Categoria::create([
            'nombre' => $request->get('nombre'),
            'descripcion' => $request->get('descripcion'),
            'status' => $request->get('estado')
        ]);
        $msj = $categoria ? 'La categoria fue creada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la categoria.';
        return redirect()->route('agregarCategoria')->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Categoria::findOrFail($request->get('id'));
        $deleted = Categoria::destroy($request->get('id'));
        $msj = $deleted ? 'La categoria fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación de la categoria.';
        return response()->json(['error'=>false,'msj' => $msj]);
    }
    public function actualizar(Request $request){
        $categoria = Categoria::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('categorias')->ignore($request->get('id'))],
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $categoria->fill($request->all());
        $actualizacion = $categoria->save();
        $msj = $actualizacion ? 'La categoria fue actualizada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de actualización de la categoria.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        return view('admin/categorias/editar')->with('categoria',Categoria::findOrFail($request->segment(4)));
    }
}
