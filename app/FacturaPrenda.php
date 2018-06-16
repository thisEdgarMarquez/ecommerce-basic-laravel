<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaPrenda extends Model
{
    protected $table = 'facturas_prendas';
    protected $fillable = ['idfactura','idprenda','idtalla','cantidad'];
    public function factura_pk(){
        return $this->hasOne('App\Factura','id','idfactura');
    }
}
