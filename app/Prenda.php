<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prenda extends Model
{
    protected $fillable = ['nombre','precio','idmarca','status','idcategoria','idgenero','descripcion'];
    public function marca(){
        return $this->hasOne('App\Marca');
    }
}
