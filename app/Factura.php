<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = ['fecha','monto','idusuario','status'];
    public function usuario_pk(){
        return $this->hasOne('App\Usuario','id','idusuario');
    }
    public function facturaprendas_pk(){
        return $this->hasMany('App\FacturaPrenda','idfactura','id');
    }
}
