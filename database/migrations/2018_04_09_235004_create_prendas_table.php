<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prendas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',60)->unique();
            $table->float('precio');
            $table->integer('cantidad')->default('0');
            $table->integer('idmarca')->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('idcategoria')->unsigned();
            $table->integer('idgenero')->unsigned();
            $table->string('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prendas');
    }
}
