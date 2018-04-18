<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Proveedor;

class ProveedorController extends Controller
{
    public function index(){
        return view('admin/proveedores/index')->with('proveedores',Proveedor::paginate(10));
    }
    public function agregar(){
        return view('admin/proveedores/agregar');
    }
    public function crear(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:proveedores|max:255',
            'cedula' => 'required_if:rif,null|unique:proveedores',
            'rif' => 'required_if:cedula,null|unique:proveedores',
            'telefono1' => 'required|unique:proveedores|numeric',
            'telefono2' => 'nullable|numeric|unique:proveedores',
            'email' => 'required|unique:proveedores|email',
            'direccion' => 'required|string',
            'status' => 'required|boolean'
        ]);
        $msj = Proveedor::create($request->all()) ? 'El proveedor fue creado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación del proveedor.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        return view('admin/proveedores/editar')->with('proveedor',Proveedor::findOrFail($request->segment(4)));
    }
    public function actualizar(Request $request){
        $proveedor = Proveedor::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required',Rule::unique('proveedores')->ignore($request->get('id')),'max:255'],
            'cedula' => ['required_if:rif,null',Rule::unique('proveedores')->ignore($request->get('id'))],
            'rif' => ['required_if:cedula,null',Rule::unique('proveedores')->ignore($request->get('id'))],
            'telefono1' => ['required',Rule::unique('proveedores')->ignore($request->get('id')),'numeric'],
            'telefono2' => ['nullable','numeric',Rule::unique('proveedores')->ignore($request->get('id'))],
            'email' => ['required',Rule::unique('proveedores')->ignore($request->get('id')),'email'],
            'direccion' => 'required|string',
            'status' => 'required|boolean'
        ]);
        $proveedor->fill($request->all());
        $actualizacion = $proveedor->save();
        $msj = $actualizacion ? 'El proveedor fue modificado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modifcación del proveedor.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Proveedor::findOrFail($request->get('id'));
        $msj = Proveedor::destroy($request->get('id')) ? 'El proveedor fue eliminado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación del proveedor';
        return response()->json(['error' => false,'msj'=>$msj]);
    }
}
