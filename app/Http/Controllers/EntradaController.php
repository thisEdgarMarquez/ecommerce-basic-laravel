<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrada;
use App\Proveedor;
use App\Prenda;
use App\Talla;
use App\EntradaTalla;
class EntradaController extends Controller
{
    public function index(){
        $entradas = Entrada::with('proveedor_pk')->paginate(10);
        return view('admin/entradas/index',compact('entradas'));
    }
    public function agregar(){
        $proveedores = Proveedor::where('status',1)->get();
        $prendas = Prenda::where('status',1)->with('prendastallas_pk')->get()->toArray();
        $tallas = Talla::where('status',1)->get()->toArray();
        $rel_tallas = $prendas[0]['prendastallas_pk'];
        $aux = [];
        foreach($tallas as $key => $talla){
            foreach($rel_tallas as $key2 => $rel_talla){
                if($rel_talla['idtalla'] == $talla['id']) 
                    array_push($aux, ['id' => $talla['id'], 
                                      'medida' => $talla['medida']]);
            }
        }
        $rel_tallas = $aux;
        return view('admin/entradas/agregar',compact('proveedores','prendas','rel_tallas'));
    }
    public function gettallas(Request $request){
        
        $prendas = Prenda::where('id',$request->get('idprenda'))->with('prendastallas_pk')->get()->toArray();
        $tallas = Talla::where('status',1)->get()->toArray();
        $rel_tallas = $prendas[0]['prendastallas_pk'];
        $aux = [];
        foreach($tallas as $key => $talla){
            foreach($rel_tallas as $key2 => $rel_talla){
                if($rel_talla['idtalla'] == $talla['id']) 
                    array_push($aux, ['id' => $talla['id'], 
                                      'medida' => $talla['medida']]);
            }
        }
        $rel_tallas = $aux;
        return response()->json(['tallas'=> $rel_tallas]);
    }
    public function crear(Request $request){
        $this->validate($request,[
            'idproveedor' => 'required|exists:proveedores,id|numeric',
            'fecha' => 'required|date',
            'idprenda' => 'required|array',
            'idtalla' => 'required|array',
            'cantidad' => 'required|array',
            'status' => 'required|boolean'
        ]);
        $entrada = Entrada::create($request->all());
        $resultado;
        if($entrada){
            for ($i=0; $i < count($request->get('idprenda')); $i++) { 
                $resultado = EntradaTalla::create([
                    'identrada' => $entrada->id,
                    'idprenda' => $request->get('idprenda')[$i],
                    'idtalla' => $request->get('idtalla')[$i],
                    'cantidad' => $request->get('cantidad')[$i]
                ]);
            }
            $msj = $resultado ? 'La entrada fue creada con éxito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la entrada.';
        }else {$msj = 'Lo sentimos, ocurrió un error en el proceso de creación de la entrada.';}
        return redirect()->back()->with('msj',$msj);
    }
    public function getEntradaDetalle(Request $request){
        $entrada = Entrada::findOrFail($request->segment(4))->with('proveedor_pk','entradastallas_pk')->get();
        $prendas = Prenda::all();
        $tallas = Talla::all();
        return view('admin/entradas/ver',compact('entrada','prendas','tallas'));
    }
}
