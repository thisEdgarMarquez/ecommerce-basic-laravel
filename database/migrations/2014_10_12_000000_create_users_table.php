<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',60);
            $table->string('apellido',60);
            $table->string('email',60)->unique();
            $table->string('password');
            $table->integer('nivel')->default(1);
            $table->char('telefono1',11);
            $table->char('telefono2',11)->nullable();
            $table->boolean('status')->default(1);
            $table->char('cedula',8)->unique();
            $table->char('rif',11)->unique()->nullable();
            $table->string('direccion');
            $table->rememberToken();
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
        Schema::dropIfExists('usuarios');
    }
}
