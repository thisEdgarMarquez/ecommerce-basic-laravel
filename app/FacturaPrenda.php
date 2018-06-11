<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaPrenda extends Model
{
    protected $table = 'facturas_prendas';
    protected $fillable = ['idfactura','idprenda','idcolor','cantidad'];
}
