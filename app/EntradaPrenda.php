<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaPrenda extends Model
{
    protected $table = 'entradas_prendas';
    protected $fillable = ['identrada','idprenda','idtalla','idcolor','cantidad'];
    public function talla_pk(){
        return $this->hasOne('App\Talla','id','idtalla');
    }
    public function color_pk(){
        return $this->hasOne('App\Color','id','idcolor');
    }
}
