<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorPrenda extends Model
{
    protected $table = 'colores_prendas';
    protected $fillable = ['idprenda','idcolor','idtalla'];
}
