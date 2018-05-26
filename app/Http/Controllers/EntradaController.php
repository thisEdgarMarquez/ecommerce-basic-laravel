<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrada;
use App\Proveedor;
use App\Prenda;
use App\Talla;
use App\Color;
use App\EntradaPrenda;
class EntradaController extends Controller
{
    public function index(){
        $entradas = Entrada::with('proveedor_pk', 'entradastallas_pk')->paginate(10);
        return view('admin/entradas/index',compact('entradas'));
    }
    public function agregar(){
        $proveedores = Proveedor::where('status',1)->get();
        $prendas = Prenda::where('status',1)->get()->toArray();
        $tallas = Talla::where('status',1)->get()->toArray();
        $colores = Color::where('status',1)->get()->toArray();
        return view('admin/entradas/agregar',compact('proveedores','prendas','tallas', 'colores'));
    }
    
    public function crear(Request $request){
        $this->validate($request,[
            'idproveedor' => 'required|exists:proveedores,id|numeric',
            'fecha' => 'required|date',
            'idprenda' => 'required|array',
            'idtalla' => 'required|array',
            'idcolor' => 'required|array',
            'cantidad' => 'required|array',
            'status' => 'required|boolean'
        ]);
        $entrada = Entrada::create($request->all());
        $resultado;
        if($entrada){
            for ($i=0; $i < count($request->get('idprenda')); $i++) { 
                $resultado = EntradaPrenda::create([
                    'identrada' => $entrada->id,
                    'idprenda' => $request->get('idprenda')[$i],
                    'idtalla' => $request->get('idtalla')[$i],
                    'idcolor' => $request->get('idcolor')[$i],
                    'cantidad' => $request->get('cantidad')[$i]
                ]);
            }
            $msj = $resultado ? 'La entrada fue creada con éxito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la entrada.';
        }else {$msj = 'Lo sentimos, ocurrió un error en el proceso de creación de la entrada.';}
        return redirect()->back()->with('msj',$msj);
    }
    public function getEntradaDetalle(Request $request){
        $entrada = Entrada::where('id',$request->segment(4))->with('proveedor_pk', 'entradaprenda_pk')->get();
        $prendas = Prenda::all();
        $tallas = Talla::all();
        $colores = Color::all();
        return view('admin/entradas/ver',compact('entrada','prendas','tallas', 'colores'));
    }
    public function editar(Request $request){
        $entrada = Entrada::where('id',$request->segment(4))->with('proveedor_pk', 'entradaprenda_pk')->get();
        $proveedores = Proveedor::where('status',1)->get();
        $prendas = Prenda::where('status',1)->get()->toArray();
        $tallas = Talla::where('status',1)->get()->toArray();
        $colores = Color::where('status',1)->get()->toArray();
        $mapEntradaPrenda = array();
        foreach($entrada[0]->entradaprenda_pk as $entrada){
            
            $nomPrenda;
            $medTalla;
            $nomColor;
            $identrada = $entrada->id;

            foreach($prendas as $prenda){
                if($prenda['id'] == $entrada->idprenda) {
                    $nomPrenda = $prenda['nombre'];
                }
            }
            foreach($tallas as $talla){
                if($talla['id'] == $entrada->idtalla) {
                    $medTalla = $talla['medida'];
                }
            }
            foreach($colores as $color){
                if($color['id'] == $entrada->idcolor) {
                    $nomColor = $color['nombre'];
                }
            }

            array_push($mapEntradaPrenda, [
                'identrada_prenda' => $entrada->id,
                '_prenda'=>[
                    'idprenda'=> $entrada->idprenda,
                    'nombre'=> $nomPrenda
                ],
                '_talla' => [
                    'idtalla'=> $entrada->idtalla,
                    'medida'=> $medTalla
                ],
                '_color'=> [
                    'idcolor'=> $entrada->idcolor,
                    'nombre'=> $nomColor
                ],
                'cantidad'=> $entrada->cantidad
            ]);
        }

        $entrada = Entrada::where('id',$request->segment(4))->with('proveedor_pk', 'entradaprenda_pk')->get();
        return view('admin/entradas/editar',compact('entrada','proveedores','prendas','tallas', 'colores', 'mapEntradaPrenda'));
    }
    public function actualizar(Request $request){
        $entrada = Entrada::findOrFail($request->get('id'));
        $this->validate($request,[
            'idproveedor' => 'required|exists:proveedores,id|numeric',
            'fecha' => 'required|date',
            'status' => 'required|boolean',
            'idprendaelimnar' => 'array'
        ]); 
        $entrada->fill($request->all());
        $actualizacion = $entrada->save();
        if($actualizacion){
            if(!empty($request->get('idprendaeliminar')))
            {
                foreach ($request->get('idprendaeliminar') as $id) {
                    EntradaPrenda::destroy($id);
                }
            }
            if(!empty($request->get('idprenda'))){
                for ($i=0; $i < count($request->get('idprenda')); $i++) { 
                    EntradaPrenda::create([
                        'identrada' => $entrada->id,
                        'idprenda' => $request->get('idprenda')[$i],
                        'idtalla' => $request->get('idtalla')[$i],
                        'idcolor' => $request->get('idcolor')[$i],
                        'cantidad' => $request->get('cantidad')[$i]
                    ]);
                }
            }
        }
        $msj = $actualizacion ? 'La entrada fue modificada con éxito.' : 'Lo sentimos, ocurrió un error al modificar de la entrada.';
        return redirect()->back()->with('msj',$msj); 
    }
    public function eliminar(Request $request){
        Entrada::findOrFail($request->get('id'));    
        $msj = Entrada::destroy($request->get('id')) ? 'La entrada fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación de la entrada.';
        return response()->json(['error' => false, 'msj' => $msj]);
    }
}
