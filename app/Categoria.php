<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre','descripcion','status'];

    public function prendas_pk(){
        return $this->hasMany('App\Prenda','idcategoria','id');
    }
}
