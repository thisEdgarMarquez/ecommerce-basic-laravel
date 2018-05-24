<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Prenda;

class InicioController extends Controller
{
    public function index()
    {
        $categorias = Categoria::where('status',1)->get();
        $prendas = Prenda::where('status',1)->with('categoria_pk')->get();
        return view('home',compact('categorias','prendas'));
    }
}
