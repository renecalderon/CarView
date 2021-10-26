<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuestas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_propuesta');
            $table->string('vin')->nullable();
            $table->string('total')->nullable();
            $table->string('manodeobra')->nullable();
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->string('hashfile')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('reparacion_id');
            $table->foreign('reparacion_id')->references('id')->on('reparaciones');

            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->unsignedBigInteger('semaforo_id')->nullable();
            $table->foreign('semaforo_id')->references('id')->on('semaforos');

            /* $table->unsignedBigInteger('refaccion_id');
            $table->foreign('refaccion_id')->references('id')->on('refacciones');

            $table->unsignedBigInteger('trabajo_id');
            $table->foreign('trabajo_id')->references('id')->on('trabajos'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propuestas');
    }
}
