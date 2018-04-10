<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasPrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_prendas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('identrada')->unsigned();
            $table->integer('idprenda')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('identrada')->references('id')->on('entradas');
            $table->foreign('idprenda')->references('id')->on('prendas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas_prendas');
    }
}
