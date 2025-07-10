<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_evaluacion');
            $table->unsignedBigInteger('id_vocero');
            $table->unsignedBigInteger('id_comunidad');
            $table->json('imagenes');
            $table->text('latitud');
            $table->text('longitud');
            $table->text('direccion');
            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_vocero')->references('id')->on('voceros');
            
            $table->foreign('id_evaluacion')->references('id')->on('evaluaciones');

             // Establecer relación con la tabla de comunas
             $table->foreign('id_comunidad')->references('id')->on('comunidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignaciones');
    }
};
