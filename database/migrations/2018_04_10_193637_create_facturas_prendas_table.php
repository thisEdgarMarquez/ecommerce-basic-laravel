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
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('idfactura')->references('id')->on('facturas');
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
        Schema::dropIfExists('facturas_prendas');
    }
}
