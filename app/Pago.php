<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = ['idfactura','tipo_pago','nombre_banco','numero_referencia','monto','adjunto','idusuario'];

    public function usuario_pk(){
        return $this->hasMany('App\Usuario','id','idusuario');
    }
}
