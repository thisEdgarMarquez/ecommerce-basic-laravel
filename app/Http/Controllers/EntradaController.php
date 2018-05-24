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
        /* $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('prendas')->ignore($request->get('id'))],
            'precio' => 'required|numeric',
            'idmarca' => 'required|integer|exists:marcas,id',
            'idcategoria' => 'required|integer|exists:categorias,id',
            'idgenero' => 'required|integer|exists:generos,id',
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]); */
        /* $prenda->fill($request->all());
        $actualizacion = $prenda->save();
        $msj = $actualizacion ? 'La Prenda fue modificada con éxito.' : 'Lo sentimos, ocurrió un error  al modificar de la prenda.'; */
        
        return redirect()->back()->with('msj',$msj);
    }
}
