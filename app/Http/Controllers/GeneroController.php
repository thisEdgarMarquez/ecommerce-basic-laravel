<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Genero;

class GeneroController extends Controller
{
    public function index(){
        $generos = Genero::paginate(10);
        return view('admin/generos/index',['generos'=>$generos]);
    }
    public function agregar(){
        return view('admin/generos/agregar');
    }
    public function crear(Request $request,Genero $genero){
        $this->validate($request,[
            'nombre' => 'required|unique:generos|max:255',
            'status' => 'required|boolean'
        ]);
        $msj = $genero->create($request->all()) ? 'El género fue creado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación del género.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Genero::findorFail($request->get('id'));    
        $msj = Genero::destroy($request->get('id')) ? 'El género fue eliminado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación del género.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
    public function editar(Request $request){
        return view('admin/generos/editar')->with('genero',Genero::findOrFail($request->segment(4)));
    }
    public function actualizar(Request $request){
        $genero = Genero::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('generos')->ignore($request->get('id'))],
            'status' => 'required|boolean'
        ]);
        $genero->fill($request->all());
        $actualizacion = $genero->save();
        $msj = $actualizacion ? 'El género fue modificado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación del género.';
        return redirect()->back()->with('msj',$msj);
    }
}