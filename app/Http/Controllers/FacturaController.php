<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Factura;
use App\Prenda;
use App\Talla;
use App\Color;
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
        $colores = Color::all();
        return view('admin/facturas/ver',compact('factura','colores','tallas','prendas'));
    }
}
