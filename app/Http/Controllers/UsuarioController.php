<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
use App\Factura;
use App\Pago;
use Illuminate\Validation\Rule;
class UsuarioController extends Controller
{
    public function index(){
        return view('admin/usuarios/index')->with('usuarios',Usuario::paginate(10));
    }
    public function agregar(){
        return view('admin/usuarios/agregar');
    }
    public function crear(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:usuarios|max:255',
            'apellido' => 'required|unique:usuarios|max:255',
            'cedula' => 'required_without:rif|unique:usuarios|nullable',
            'rif' => 'required_without:cedula|unique:usuarios|nullable',
            'telefono1' => 'required|unique:usuarios|numeric',
            'telefono2' => 'nullable|numeric|unique:usuarios',
            'email' => 'required|unique:usuarios|email',
            'direccion' => 'required|string',
            'nivel' => 'required|numeric',
            'status' => 'required|boolean',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $usuario = Usuario::create([
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'telefono1' => $request->get('telefono1'),
            'telefono2' => $request->get('telefono2'),
            'cedula' => $request->get('cedula'),
            'rif' => $request->get('rif'),
            'direccion' => $request->get('direccion'),
            'status' => $request->get('status'),
            'password' => Hash::make($request->get('password'))
        ]);
        $msj = $usuario ? 'El usuario fue creado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de creación del usuario.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        return view('admin/usuarios/editar')->with('usuario',Usuario::findOrFail($request->segment(4)));
    }
    public function actualizar(Request $request){
        $usuario = Usuario::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required',Rule::unique('usuarios')->ignore($request->get('id')),'max:255'],
            'apellido' => ['required',Rule::unique('usuarios')->ignore($request->get('id')),'max:255'],
            'cedula' => ['required_without:rif',Rule::unique('usuarios')->ignore($request->get('id')),'nullable'],
            'rif' => ['required_without:cedula',Rule::unique('usuarios')->ignore($request->get('id')),'nullable'],
            'telefono1' => ['required',Rule::unique('usuarios')->ignore($request->get('id')),'numeric'],
            'telefono2' => ['nullable','numeric',Rule::unique('usuarios')->ignore($request->get('id'))],
            'email' => ['required',Rule::unique('usuarios')->ignore($request->get('id')),'email'],
            'direccion' => 'required|string',
            'nivel' => 'required|numeric',
            'status' => 'required|boolean',
            'password' => ($request->get('password') != "") ? 'required|string|min:6|confirmed' : "",
        ]);
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->email = $request->get('email');
        $usuario->telefono1 = $request->get('telefono1');
        $usuario->telefono2 =  $request->get('telefono2');
        $usuario->cedula = $request->get('cedula');
        $usuario->rif = $request->get('rif');
        $usuario->direccion = $request->get('direccion');
        $usuario->status = $request->get('status');
        if($request->get('password') != "") $usuario->password = Hash::make($request->get('password'));
        $actualizacion = $usuario->save();
        $msj = $actualizacion ? 'El usuario fue modificada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación del usuario.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Usuario::findOrFail($request->get('id'));
        $msj = Usuario::destroy($request->get('id')) ? 'El usuario fue eliminado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación del usuario.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
    public function miperfil(){
        $usuario = Usuario::findOrFail(Auth::id());
        $facturas = Factura::where('idusuario',Auth::id())->with('pagos_pk')->paginate(10);
        return view('perfil',compact('usuario','facturas'));
    }
    public function editarPerfil(Request $request){
        $usuario = Usuario::findOrFail(Auth::id());
        $this->validate($request,[
            'nombre' => ['required',Rule::unique('usuarios')->ignore(Auth::id()),'max:255'],
            'apellido' => ['required',Rule::unique('usuarios')->ignore(Auth::id()),'max:255'],
            'cedula' => ['required_without:rif',Rule::unique('usuarios')->ignore(Auth::id()),'nullable'],
            'rif' => ['required_without:cedula',Rule::unique('usuarios')->ignore(Auth::id()),'nullable'],
            'telefono1' => ['required',Rule::unique('usuarios')->ignore(Auth::id()),'numeric'],
            'telefono2' => ['nullable','numeric',Rule::unique('usuarios')->ignore(Auth::id())],
            'email' => ['required',Rule::unique('usuarios')->ignore(Auth::id()),'email'],
            'direccion' => 'required|string',
            'password' => ($request->get('password') != "") ? 'required|string|min:6|confirmed' : "",
        ]);
        $usuario->nombre = $request->get('nombre');
        $usuario->apellido = $request->get('apellido');
        $usuario->email = $request->get('email');
        $usuario->telefono1 = $request->get('telefono1');
        $usuario->telefono2 =  $request->get('telefono2');
        $usuario->cedula = $request->get('cedula');
        $usuario->rif = $request->get('rif');
        $usuario->direccion = $request->get('direccion');
        if($request->get('password') != "") $usuario->password = Hash::make($request->get('password'));
        $actualizacion = $usuario->save();
        $msj = $actualizacion ? 'Tu perfil fue modificado con exito.' : 'Lo sentimos, ocurrió un error en el proceso de modificación de tu perfil.';
        return redirect()->back()->with('msj',$msj);
    }
}
