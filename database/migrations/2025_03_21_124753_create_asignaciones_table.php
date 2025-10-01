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
            $table->unsignedBigInteger('id_ayuda');
            $table->string('descri_alcance');
            $table->string('moneda_presu', 3); // Added this line (VES, USD, EUR)
            $table->text('presupuesto');
            $table->string('impacto_ambiental');
            $table->string('impacto_social');
            $table->json('imagenes');
            $table->text('latitud');
            $table->text('longitud');
            $table->text('direccion');
            $table->date('fecha_inicio');
            $table->date('duracion_estimada');
            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_evaluacion')->references('id')->on('evaluaciones');

            $table->foreign('id_vocero')->references('id')->on('voceros');

            $table->foreign('id_comunidad')->references('id')->on('comunidades');

            $table->foreign('id_ayuda')->references('id')->on('ayudas');
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
