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
            $table->unsignedBigInteger('id_proyecto');
            $table->string('descri_alcance');
            $table->text('presupuesto');
            $table->string('impacto_ambiental');
            $table->string('impacto_social');
            $table->string('descri_obra');
            $table->date('fecha_inicio');
            $table->date('duracion_estimada');

            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
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
