<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Prenda;
use App\Categoria;
use App\Genero;
use App\Marca;

class PrendaController extends Controller
{
    public function index(){
        $prendas = Prenda::with('marca_pk','categoria_pk','genero_pk')->paginate(10);
        return view('admin/prendas/index',compact('prendas'));
    }
    public function agregar(){
        $categorias = Categoria::where('status',1)->orderBy('nombre','asc')->get();
        $generos = Genero::where('status',1)->get();
        $marcas = Marca::where('status',1)->orderBy('nombre','asc')->get();
        return view('admin/prendas/agregar',compact('categorias','generos','marcas'));
    }
    public function crear(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:prendas|max:255',
            'precio' => 'required|numeric',
            'idmarca' => 'required|integer|exists:marcas,id',
            'idcategoria' => 'required|integer|exists:categorias,id',
            'idgenero' => 'required|integer|exists:generos,id',
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $msj = Prenda::create($request->all()) ? 'La prenda fue creada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la prenda.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        $prenda = Prenda::findOrFail($request->segment(4));
        $categorias = Categoria::where('status',1)->orderBy('nombre','asc')->get();
        $generos = Genero::where('status',1)->get();
        $marcas = Marca::where('status',1)->orderBy('nombre','asc')->get();
        return view('admin/prendas/editar',compact('categorias','generos','marcas','prenda'));
    }
    public function actualizar(Request $request){
        $prenda = Prenda::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('prendas')->ignore($request->get('id'))],
            'precio' => 'required|numeric',
            'idmarca' => 'required|integer|exists:marcas,id',
            'idcategoria' => 'required|integer|exists:categorias,id',
            'idgenero' => 'required|integer|exists:generos,id',
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $prenda->fill($request->all());
        $actualizacion = $prenda->save();
        $msj = $actualizacion ? 'La prenda fue modificada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación de la prenda.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Prenda::findOrFail($request->get('id'));
        $msj = Prenda::destroy($request->get('id')) ? 'La prenda fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación de la prenda.';
        return response()->json(['error' => false,'msj' => $msj]);
    }
}
