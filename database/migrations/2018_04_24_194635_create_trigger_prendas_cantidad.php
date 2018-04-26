<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerPrendasCantidad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER trigger_updateCantidadPrenda AFTER INSERT ON entradas_prendas FOR EACH ROW BEGIN
        UPDATE prendas SET cantidad=cantidad+NEW.cantidad
        WHERE prendas.id=NEW.idprenda;
        END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
