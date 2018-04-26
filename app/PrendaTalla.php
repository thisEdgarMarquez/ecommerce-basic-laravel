<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrendaTalla extends Model
{
    protected $table = 'prendas_tallas';
    protected $fillable = ['idprenda','idtalla','cantidad'];

    public function prenda_pk(){
        return $this->hasOne('App\Prenda','id','idprenda');
    }
    public function talla_pk(){
        return $this->hasOne('App\Talla','idtalla','id');
    }
}
