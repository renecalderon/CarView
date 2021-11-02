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
            $table->mediumInteger('propuesta_numero');
            $table->string('propuesta_fecha', 15);
            $table->string('propuesta_tipo', 30);
            $table->integer('propuesta_referencia');
            $table->string('propuesta_asesor', 30);
            $table->string('propuesta_descripcion', 100);
            $table->string('propuesta_matricula', 15);
            $table->string('propuesta_vin', 17);
            $table->string('propuesta_modelo', 50);
            $table->string('propuesta_kilometros', 10);
            $table->decimal('propuesta_total_manodeobra', 6, 2);
            $table->decimal('propuesta_total_refacciones', 6, 2);
            $table->decimal('propuesta_base', 6, 2);
            $table->decimal('propuesta_iva', 5, 2);
            $table->decimal('propuesta_total', 6, 2);
            $table->string('propuesta_filename');
            $table->string('propuesta_path');
            $table->string('propuesta_hashfile');
            $table->timestamps();

            $table->unsignedBigInteger('reparacion_id');
            $table->foreign('reparacion_id')->references('id')->on('reparaciones');

            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');

            $table->unsignedBigInteger('semaforo_id')->nullable();
            $table->foreign('semaforo_id')->references('id')->on('semaforos');

            /* $table->string('nombre_propuesta');
            $table->string('vin')->nullable();
            $table->string('total')->nullable();
            $table->decimal('manodeobra')->nullable(); */

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
