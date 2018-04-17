<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Color;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    public function index(){
        return view('admin/colores/index')->with('colores', Color::paginate(10));
    }
    public function agregar(){
        return view('admin/colores/agregar');
    }
    public function crear(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:colores|max:255',
            'hex' => 'required|alpha_num|max:6|min:6',
            'status' => 'required|boolean'
        ]);
        $msj = Color::create($request->all()) ? 'El color ha sido creado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación del color.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        return view('admin/colores/editar')->with('color',Color::findOrFail($request->segment(4)));
    }
    public function actualizar(Request $request){
        $color = Color::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('colores')->ignore($request->get('id'))],
            'hex' => 'required|alpha_num|max:6|min:6',
            'status' => 'required|boolean'
        ]);
        $color->fill($request->all());
        $actualizacion = $color->save();
        $msj = $actualizacion ? 'El color fue modificado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modifación del color.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Color::findOrFail($request->get('id'));
        $msj = Color::destroy($request->get('id')) ? 'El color fue eliminado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación del color.';
        return response()->json(['error' => false,'msj' => $msj]);
    }
}
