<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Factura;
use App\Prenda;
use App\Talla;
/* use App\Color;
 */use App\Marca;
use App\Genero;
use App\Usuario;
class FacturaController extends Controller
{
    public function index(){
        $facturas = Factura::with('usuario_pk')->orderBy('id','desc')->paginate(10);
        return view('admin/facturas/index',compact('facturas'));
    }
    public function detalles(Request $request){
        Factura::findOrFail($request->segment(4));
        $factura = Factura::where('id',$request->segment(4))->with('usuario_pk', 'facturaprendas_pk')->get();
        $prendas = Prenda::all();
        $tallas = Talla::all();
/*         $colores = Color::all();
 */        return view('admin/facturas/ver',compact('factura','tallas','prendas'));
    }
    public function pdf(Request $request){
        $data = Factura::findOrFail($request->segment(3));
        if(\Auth::user()->nivel == 2 || \Auth::id() == $data->idusuario)
        {
            $factura = Factura::where('id',$request->segment(3))->with('facturaprendas_pk','usuario_pk')->get();
            $prendas = array();
            foreach($factura as $data){
                foreach($data->facturaprendas_pk as $prenda){
                    $data = Prenda::where('id',$prenda->idprenda)->get()->toArray();
                    $marca = Marca::where('id',$data[0]['idmarca'])->get()->toArray();
                    $talla = Talla::where('id',$prenda->idtalla)->get()->toArray();
                    //$genero = Genero::where('id',$data[9])->get()->toArray();
                    array_push($prendas,[
                        'id' => $data[0]['id'],
                        'nombre' => $data[0]['nombre'],
                        'precio' => $data[0]['precio'],
                        'marca' => $marca[0]['nombre'],
                        'talla' => $talla[0]['medida'],
                        'cantidad' => $prenda->cantidad,
                        //'genero' => $genero['0']['nombre']
                    ]);   
                }
            }
            $pdf = PDF::loadView('pdf/factura',compact('factura','prendas'));
            return $pdf->download('factura.pdf');
        }else{
            return redirect('/');
        }
    }
}
