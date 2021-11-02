<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefaccionesTable extends Migration
{
    public function up()
    {
        Schema::create('refacciones', function (Blueprint $table) {
            $table->id();
            $table->string('vin');
            $table->string('total');
            $table->string('filename');
            $table->string('path');
            $table->string('hashfile');
            $table->timestamps();

            $table->unsignedBigInteger('reparacion_id')->nullable();
            $table->foreign('reparacion_id')->references('id')->on('reparaciones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('refacciones');
    }
}
