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
            $table->integer('cantidad')->default('0');
            $table->timestamps();
            $table->foreign('identrada')->references('id')->on('entradas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idprenda')->references('id')->on('prendas')->onUpdate('cascade');
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
