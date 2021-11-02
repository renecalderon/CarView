<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalleresTable extends Migration
{
    public function up()
    {
        Schema::create('talleres', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('descripcion');
            $table->timestamps();

            $table->unsignedBigInteger('sucursal_id');
            $table->foreign('sucursal_id')->references('id')->on('sucursales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('talleres');
    }
}
