<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColoresPrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colores_prendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idprenda')->unsigned();
            $table->integer('idtalla')->unsigned();
            $table->integer('idcolor')->unsigned();
            $table->integer('cantidad')->default('0');
            $table->timestamps();
            $table->foreign('idprenda')->references('id')->on('prendas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idtalla')->references('id')->on('tallas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idcolor')->references('id')->on('colores')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colores_prendas');
    }
}
