<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasPrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas_prendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfactura')->unsigned();
            $table->integer('idprenda')->unsigned();
            $table->integer('idcolor')->unsigned();
            $table->integer('idtalla')->unsigned();
            $table->integer('cantidad')->default('0');
            $table->timestamps();
            $table->foreign('idfactura')->references('id')->on('facturas')->onUpdate('cascade');
            $table->foreign('idprenda')->references('id')->on('prendas')->onUpdate('cascade');
            $table->foreign('idcolor')->references('id')->on('colores')->onUpdate('cascade');
            $table->foreign('idtalla')->references('id')->on('tallas')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas_prendas');
    }
}
