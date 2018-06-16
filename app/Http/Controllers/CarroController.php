<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Prenda;
use App\Talla;
use App\Factura;
use App\FacturaPrenda;

class CarroController extends Controller
{
    public function __construct(){
        if(!\Session::has('carro')){
            \Session::put('carro',array());
        }
    } 
    public function index(){
        $total = $this->total();
        $tallas = Talla::where('status',1)->get();
        return view('carro.index',compact('tallas','total'));
    }
    private function total(){
        if(count(\Session::get('carro')) > 0){
            $total = 0;
            foreach(\Session::get('carro') as $item){
                $total = ($item['precio'] * $item['cantidad']) + $total;
            }
            return $total;
        }
    }
    public function agregar(Request $request){
        $this->validate($request,[
            'id' => 'required|exists:prendas',
            'talla' => 'required|exists:tallas,id',
            'nombre' => 'required',
            'cantidad' => 'required',
            'precio' => 'required',
            'img' => 'required'
        ]);
        $carro = \Session::get('carro');
        $item = array(
            'id' => $request->get('id'),
            'nombre' => $request->get('nombre'),
            'cantidad' => $request->get('cantidad'),
            'id_talla' => $request->get('talla'),
            'precio' => $request->get('precio'),
            'img' => $request->get('img')
        );
        $carro[count($carro)+1] = $item;
        \Session::put('carro',$carro);
        return redirect()->route('carro');
    }
    public function eliminar($rowitem){
        $carro = \Session::get('carro');
        unset($carro[$rowitem]);
        \Session::put('carro',$carro);
        return redirect()->route('carro');
    }
    public function editar(Request $request){
        $this->validate($request,[
            'id' => 'required',
            'cantidad' => 'required|min:1'
        ]);
        $carro = \Session::get('carro');
        $carro[$request->get('id')]['cantidad'] = $request->get('cantidad');
        \Session::put('carro',$carro);
    }
    public function comprar(){
        $result = Factura::create(array(
            'fecha' => now(),
            'monto' => $this->total(),
            'idusuario' => \Auth::user()->id,
            'status' => 0
        ));
        if($result){
            $id = Factura::all()->last()->id;
            foreach(\Session::get('carro') as $item){
                $result = FacturaPrenda::create(array(
                    'idfactura' => $id,
                    'idprenda' => $item['id'],
                    'idtalla' => $item['id_talla'], 
                    'cantidad' => $item['cantidad']
                ));
                \Session::put('carro',array());
                $result ? $msj = array('msj' => 'Su pedido fue enviado con éxito a la administración de la tienda.','error' => false, 'idfactura' => $id) : $msj = array('error' => true, 'msj' => 'Lo sentimos, ocurrio un error en el proceso de envio de su pedido. Le recomendamos colocarse en contacto con la administración.');
            }
        }else{
            $msj = array('error' => true, 'msj' => 'Lo sentimos, ocurrió un error en el proceso de envío de su pedido. Le recomendamos colocarse en contacto con la administración. ');
        }
        return view('carro/compra',compact('msj'));
    }
}
