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
            $table->timestamps();
            $table->foreign('idprenda')->references('id')->on('prendas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idtalla')->references('id')->on('tallas')->onDelete('cascade')->onUpdate('cascade');
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
