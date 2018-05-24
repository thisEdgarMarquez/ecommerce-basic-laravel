<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable = ['idproveedor','fecha','status'];
    public function proveedor_pk(){
        return $this->belongsTo('App\Proveedor','idproveedor');
    }
    public function entradastallas_pk(){
        return $this->hasMany('App\EntradaTalla','identrada','id');
    }
    public function entradaprenda_pk(){
        return $this->hasMany('App\EntradaPrenda','identrada','id');
    }
}
