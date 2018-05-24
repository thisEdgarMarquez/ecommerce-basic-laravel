<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Talla;
class TallaController extends Controller
{
    public function index(){
        return view('admin/tallas/index')->with('tallas',Talla::paginate(10));
    }
    public function agregar(){
        return view('admin/tallas/agregar');
    }
    public function crear(Request $request){
        $this->validate($request,[
            'medida' => 'required|unique:tallas|max:255',
            'status' => 'required|boolean'
        ]);
        $msj = Talla::create($request->all()) ? 'La talla fue creado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la talla.';
        return redirect()->back()->with('msj',$msj);
    } 
    public function editar(Request $request){
        return view('admin/tallas/editar')->with('talla',Talla::findOrFail($request->segment(4)));
    }
    public function actualizar(Request $request){
        $talla = Talla::findOrFail($request->get('id'));
        $this->validate($request,[
            'medida' => ['required','max:255',Rule::unique('tallas')->ignore($request->get('id'))],
            'status' => 'required|boolean'
        ]);
        $talla->fill($request->all());
        $actualizacion = $talla->save();
        $msj = $actualizacion ? 'La talla fue modificada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación de la talla.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Talla::findOrFail($request->get('id'));
        $msj = Talla::destroy($request->get('id')) ? 'La talla fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación de la talla.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
}
