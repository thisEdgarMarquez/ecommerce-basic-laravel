<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrendasTallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prendas_tallas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idprenda')->unsigned();
            $table->integer('idtalla')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('idprenda')->references('id')->on('prendas');
            $table->foreign('idtalla')->references('id')->on('tallas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prendas_tallas');
    }
}
