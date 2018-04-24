<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrendaTalla extends Model
{
    protected $table = 'prendas_tallas';
    protected $fillable = ['idprenda','idtalla','cantidad'];

    public function prenda_pk(){
        return $this->belongsTo('App\Prenda','id','idprenda');
    }
}
