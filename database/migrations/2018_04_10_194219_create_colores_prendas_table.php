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
            $table->integer('idcolor')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('idprenda')->references('id')->on('prendas');
            $table->foreign('idcolor')->references('id')->on('colores');
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
