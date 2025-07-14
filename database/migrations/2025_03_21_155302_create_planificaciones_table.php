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
        Schema::create('planificaciones', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('id_asignacion');
            // $table->string('descri_alcance');
            // $table->string('moneda_presu', 3); // Added this line (VES, USD, EUR)
            // $table->text('presupuesto');
            // $table->string('impacto_ambiental');
            // $table->string('impacto_social');
            // $table->string('descri_obra');
            // $table->date('fecha_inicio');
            // $table->date('duracion_estimada');

            // $table->timestamps();

            // // Establecer relaciones con las tablas correspondientes
            // $table->foreign('id_asignacion')->references('id')->on('asignaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planificaciones');
    }
};
