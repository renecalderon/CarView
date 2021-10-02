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
            $table->string('parte');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->decimal('precio');
            $table->timestamps();

            $table->unsignedBigInteger('propuesta_id')->nullable();
            $table->foreign('propuesta_id')->references('id')->on('propuestas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('refacciones');
    }
}
