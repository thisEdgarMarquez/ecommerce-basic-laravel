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
            $table->foreign('idmarca')->references('id')->on('marcas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('idcategoria')->references('id')->on('categorias')->onUpdate('cascade');
            $table->foreign('idgenero')->references('id')->on('generos')->onUpdate('cascade');
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
