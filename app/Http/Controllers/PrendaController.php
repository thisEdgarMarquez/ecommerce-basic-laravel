<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Prenda;
use App\Categoria;
use App\Genero;
use App\Marca;
use App\Talla;
use App\EntradaPrenda;

class PrendaController extends Controller
{
    public function index(){
        $prendas = Prenda::with('marca_pk','categoria_pk','genero_pk')->paginate(10);
        return view('admin/prendas/index',compact('prendas'));
    }
    public function agregar(){
        $categorias = Categoria::where('status',1)->orderBy('nombre','asc')->get();
        $generos = Genero::where('status',1)->get();
        $marcas = Marca::where('status',1)->orderBy('nombre','asc')->get();
        return view('admin/prendas/agregar',compact('categorias','generos','marcas','tallas'));
    }
    public function crear(Request $request){
        $this->validate($request,[
            'nombre' => 'required|unique:prendas|max:255',
            'precio' => 'required|numeric',
            'idmarca' => 'required|integer|exists:marcas,id',
            'idgenero' => 'required|integer|exists:generos,id',
            'descripcion' => 'string|required',
            'imagenes["img1"]'=>'image',
            'imagenes["img2"]'=>'image',
            'imagenes["img3"]'=>'image',
            'status' => 'required|boolean'
        ]);
        
        $data = $request->all();

        if($request["imagenes"] != NULL){
            foreach($request->file('imagenes') as $key => $img){
                $random = str_random(6);
                $fileName = $random.'-'.$img->getClientOriginalName();
                $img->move('uploads', $fileName);
                $data[$key] = $fileName; 
            }
        }
        $prenda = Prenda::create($data);
        $msj = ($prenda)?'La prenda fue creada con éxito.' : 'Lo sentimos, ocurrió un error en el proceso de creación de la prenda.';
        return redirect()->back()->with('msj',$msj);
    }
    public function editar(Request $request){
        $prenda = Prenda::findOrFail($request->segment(4));
        $categorias = Categoria::where('status',1)->orderBy('nombre','asc')->get();
        $generos = Genero::where('status',1)->get();
        $marcas = Marca::where('status',1)->orderBy('nombre','asc')->get();
        $tallas = Talla::all()->toArray();
        $tallas_cant = DB::select("SELECT idtalla, SUM(cantidad) AS cantidad FROM entradas_prendas WHERE idprenda = ".$request->segment(4)." GROUP BY idtalla");
        return view('admin/prendas/editar',compact('categorias','generos','marcas','prenda','tallas', 'tallas_cant'));
    }
    public function actualizar(Request $request){
        $prenda = Prenda::findOrFail($request->get('id'));
        $this->validate($request,[
            'nombre' => ['required','max:255',Rule::unique('prendas')->ignore($request->get('id'))],
            'precio' => 'required|numeric',
            'idmarca' => 'required|integer|exists:marcas,id',
            'idcategoria' => 'required|integer|exists:categorias,id',
            'idgenero' => 'required|integer|exists:generos,id',
            'descripcion' => 'string|required',
            'status' => 'required|boolean'
        ]);
        $prenda->fill($request->all());        
        $actualizacion = $prenda->save();
        $msj = $actualizacion ? 'La Prenda fue modificada con éxito.' : 'Lo sentimos, ocurrió un error  al modificar de la prenda.';
        return redirect()->back()->with('msj',$msj);
    }
    public function eliminar(Request $request){
        Prenda::findOrFail($request->get('id'));
        $msj = Prenda::destroy($request->get('id')) ? 'La prenda fue eliminada con exito.' : 'Lo sentimos, ocurrió un error en el proceso de eliminación de la prenda.';
        return response()->json(['error' => false,'msj' => $msj]);
    }
    public function detalles(Request $request){
        $prenda = Prenda::where('id', $request->segment(2))->with('categoria_pk')->get();
        $tallas = Talla::all();
        $tallas_cant = DB::select("SELECT idtalla, SUM(cantidad) AS cantidad FROM entradas_prendas WHERE idprenda = ".$request->segment(2)." GROUP BY idtalla");
        
        $mappedTallas = array();

        foreach($tallas as $talla){
            foreach($tallas_cant as $tc){
                if($tc->idtalla == $talla['id']){
                    array_push($mappedTallas, [
                        'id'=>$talla['id'],
                        'medida'=>$talla['medida'],
                        'cantidad'=>$tc->cantidad,
                        'status'=>$talla['status']
                    ]);
                }
            }
        }
        
        $tallas = $mappedTallas;

        return view('prenda',compact('prenda','tallas'));
    }
}