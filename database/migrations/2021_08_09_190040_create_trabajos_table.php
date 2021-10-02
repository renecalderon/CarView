<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajosTable extends Migration
{
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('precio');
            $table->string('horas');
            $table->timestamps();

            $table->unsignedBigInteger('propuesta_id')->nullable();
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trabajos');
    }
}
