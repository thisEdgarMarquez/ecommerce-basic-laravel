<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Pago;
use App\Usuario;
class PagoController extends Controller
{
    public function index(){
        $pagos = Pago::with('usuario_pk')->orderBy('id','desc')->paginate(10);
        return view('admin/pagos/index',compact('pagos'));
    }
    public function editar(Request $request){
        $pago = Pago::findOrFail($request->segment('4'));
        $usuario = Usuario::findOrFail($pago->idusuario);
        return view('admin/pagos/editar',compact('pago','usuario'));
    }
    public function actualizar(Request $request){
        $pago = Pago::findOrFail($request->get('id'));
        $this->validate($request,[
            'tipo_pago' => 'required|numeric',
            'cedula_cliente' => 'required|numeric|exists:usuarios,cedula',
            'idfactura' => 'required|exists:facturas,id|numeric',
            'nombre_banco' => 'required_if:tipo_pago_admin,2|string',
            'numero_referencia' => 'required_if:tipo_pago_admin,2|integer',
            'monto' => 'required_if:tipo_pago_admin,2|integer',
            'adjunto'=>'image',
        ]);
        $data = $request->all();
        if($request->file('adjunto') != NULL){
            $random = str_random(6);
            $fileName = $random.'-'.$request->file('adjunto')->getClientOriginalName();
            $request->file('adjunto')->move('uploads', $fileName);
            $data['adjunto'] = $fileName;
        }
        $id = Usuario::select('id')->where('cedula',$request->get('cedula_cliente'))->get()->toArray();
        $data['idusuario'] = $id[0]['id'];
        $pago->fill($data);
        $result = $pago->save();
        $msj = null;
        $result ? $msj='El pago fue actualizado con exito.' : $msj = 'Lo sentimos, ocurrio un error en el proceso de actualización del pago.';
        return redirect()->back()->with('msj',$msj);
    }
    public function rechazar(Request $request){
        $pago = Pago::findOrFail($request->get('id'));
        $pago->status = 2;
        $msj = $pago->save() ? $msj='El pago fue rechazado con exito.' : $msj='Lo sentimos, ocurrio un error en el proceso de aprobación del pago.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
    public function aprobar(Request $request){
        $pago = Pago::findOrFail($request->get('id'));
        $pago->status = 1;
        $msj = $pago->save() ? $msj='El pago fue aprobado con exito.' : $msj='Lo sentimos, ocurrio un error en el proceso de aprobación del pago.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
    public function eliminar(Request $request){
        Pago::findOrFail($request->get('id'));
        $msj = Pago::destroy($request->get('id')) ? 'El pago fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación del pago.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
    public function crear(Request $request){
        $this->validate($request,[
            'tipo_pago' => 'required|numeric',
            'cedula_cliente' => 'required|numeric|exists:usuarios,cedula',
            'idfactura' => 'required|exists:facturas,id|numeric',
            'nombre_banco' => 'required_if:tipo_pago_admin,2|string',
            'numero_referencia' => 'required_if:tipo_pago_admin,2|integer',
            'monto' => 'required_if:tipo_pago_admin,2|integer',
            'adjunto'=>'image',
        ]);
        $data = $request->all();
        if($request->file('adjunto') != NULL){
            $random = str_random(6);
            $fileName = $random.'-'.$request->file('adjunto')->getClientOriginalName();
            $request->file('adjunto')->move('uploads', $fileName);
            $data['adjunto'] = $fileName;
        }
        $id = Usuario::select('id')->where('cedula',$request->get('cedula_cliente'))->get()->toArray();
        $data['idusuario'] = $id[0]['id'];
        $result = Pago::create($data);
        $msj = array();
        if($result){
            $msj = array('error' => false, 'msj' => 'El pago fue registrado con exito');
        }else{
            $msj = array('error' => true, 'msj' => 'Lo sentimos, ocurrio un error en el proceso de registro del pago.');
        }
        return view('admin/pagos/agregar',compact('msj'));
    }
    public function agregar(){
        return view('admin/pagos/agregar');
    }
    public function pagarGET($id){
        if(!Pago::where('idfactura',$id)->first())
       { Factura::FindOrFail($id);
        $factura = Factura::where('id',$id)->get();
        return view('carro/pagar',compact('factura'));}
        return redirect('/');
    }
    public function pagarPOST(Request $request){
        $this->validate($request,[
            'tipo_pago' => 'required|numeric',
            'idfactura' => 'required|exists:facturas,id|numeric',
            'nombre_banco' => 'required_if:tipo_pago,2|string',
            'numero_referencia' => 'required_if:tipo_pago,2|integer',
            'monto' => 'required_if:tipo_pago,2|integer',
            'adjunto'=>'image',
        ]);
        $data = $request->all();
        if($request->file('adjunto') != NULL){
            $random = str_random(6);
            $fileName = $random.'-'.$request->file('adjunto')->getClientOriginalName();
            $request->file('adjunto')->move('uploads', $fileName);
            $data['adjunto'] = $fileName;
        }
        $data['idusuario'] = \Auth::user()->id;
        $msj = array();
        $result = Pago::create($data);
        if($result){
            switch ($request->get('tipo_pago')) {
                case '1':
                    $msj = array('error' => false, 'msj'=> 'Su pago fue registrado con exito. Por favor diríjase a una de nuestras sucursales para continuar con el proceso.');
                    break;
                case '2':
                    $msj = array('error' => false, 'msj'=> 'Su pago fue registrado con exito. El equipo de administración fue notificado de su pago.');
                    break;
                case '3':
                    $msj = array('error' => false, 'msj'=> 'Su pago fue registrado con exito. Por favor diríjase a una de nuestras sucursales para continuar con el proceso.');
                    break;
                default:
                    break;
            }
        }else{
            $msj = array('error' => true, 'msj'=> 'Lo sentimos, ocurrio un error en el proceso.');
        }
        return view('carro/pagar',compact('msj'));
    }
}
