<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaTalla extends Model
{
    protected $table = 'entradas_prendas';
    protected $fillable = ['identrada','idprenda','idtalla','cantidad'];
    public function talla_pk(){
        return $this->hasOne('App\Talla','id','idtalla');
    }
}
