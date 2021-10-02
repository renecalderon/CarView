<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemaforosTable extends Migration
{
    public function up()
    {
        Schema::create('semaforos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('color');
            $table->string('colorname');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('semaforos');
    }
}
