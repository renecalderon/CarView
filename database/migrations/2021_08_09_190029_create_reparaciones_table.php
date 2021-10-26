<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReparacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reparaciones', function (Blueprint $table) {
            $table->id();
            $table->string('referencia')->nullable();
            $table->string('descripcion');
            $table->dateTime('fechacita')->nullable();
            $table->string('tiempoestimado')->nullable();
            $table->dateTime('fechaingreso')->nullable();
            $table->dateTime('fechafin')->nullable();
            $table->dateTime('fechaentrega')->nullable();
            $table->string('codigodmsasesorservicio')->nullable();
            $table->string('codigodmsoperadortecnico')->nullable();
            $table->string('matriculatemporal')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('situacion_id')->nullable();
            $table->foreign('situacion_id')->references('id')->on('situaciones');

            $table->unsignedBigInteger('vehiculo_id')->nullable();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');

            $table->unsignedBigInteger('taller_id')->nullable();
            $table->foreign('taller_id')->references('id')->on('talleres');

            $table->unsignedBigInteger('tipo_id')->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reparaciones');
    }
}
