<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Marca;

class MarcaController extends Controller
{
    public function index(){
        $marcas = Marca::paginate(10);
        return view('admin/marcas/index',['marcas' => $marcas]);
    }
    public function agregar(){
        return view('admin/marcas/agregar');
    }
    public function crear(Request $request,Marca $marca){
        $this->validate($request,[
            'nombre' => 'required|unique:marcas|max:255',
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $msj = $marca->create($request->all()) ? 'La marca fue creada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la marca.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        return view('admin/marcas/editar')->with('marca',Marca::findOrFail($request->segment(4)));
    }
    public function actualizar(Request $request){
        $marca = Marca::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('marcas')->ignore($request->get('id'))],
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $marca->fill($request->all());
        $actualizacion = $marca->save();
        $msj = $actualizacion ? 'La marca fue modificada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación de la marca.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Marca::findOrFail($request->get('id'));
        $msj = Marca::destroy($request->get('id')) ? 'La marca fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación de la marca.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
}
