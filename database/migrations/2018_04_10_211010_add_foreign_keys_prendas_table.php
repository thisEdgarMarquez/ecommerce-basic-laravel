<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysPrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prendas', function (Blueprint $table) {
            $table->foreign('idmarca')->references('id')->on('marcas');
            $table->foreign('idcategoria')->references('id')->on('categorias');
            $table->foreign('idgenero')->references('id')->on('generos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prendas', function (Blueprint $table) {
            //
        });
    }
}
