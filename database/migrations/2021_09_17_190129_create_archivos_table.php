<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosTable extends Migration
{
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_propuesta');
            $table->string('vin')->nullable();
            $table->string('total')->nullable();
            $table->decimal('manodeobra')->nullable();
            $table->string('filename');
            $table->string('path');
            $table->string('hashfile');
            $table->timestamps();

            $table->unsignedBigInteger('propuesta_id');
            $table->foreign('propuesta_id')->references('id')->on('propuestas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
