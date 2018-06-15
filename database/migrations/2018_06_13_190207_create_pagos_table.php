<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfactura')->unique();
            $table->integer('idusuario')->unsigned();
            $table->integer('tipo_pago');
            $table->string('nombre_banco',60)->nullable();
            $table->string('numero_referencia')->nullable();
            $table->string('monto')->nullable();
            $table->string('adjunto')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('idfactura')->references('id')->on('facturas')->onUpdate('cascade');
            $table->foreign('idusuario')->references('id')->on('usuarios')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
