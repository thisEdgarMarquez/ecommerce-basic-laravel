<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    protected $fillable = ['nombre','precio','idmarca','status','idcategoria','idgenero','descripcion'];
    public function marca_pk(){
        return $this->hasOne('App\Marca','id','idmarca');
    }
    public function categoria_pk(){
        return $this->hasOne('App\Categoria','id','idcategoria');
    }
    public function genero_pk(){
        return $this->hasOne('App\Genero','id','idgenero');
    }
    public function prendastallas_pk(){
        return $this->hasMany('App\PrendaTalla','idprenda','id');
    }
}
