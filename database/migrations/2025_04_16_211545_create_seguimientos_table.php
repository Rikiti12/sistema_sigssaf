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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_asignacion');
            $table->unsignedBigInteger('id_visita');
            $table->dateTime('fecha_hor');
            $table->string('responsable_segui');
            $table->text('detalle_segui');
            $table->string('gasto'); 
            $table->string('estado_actual');
            $table->text('riesgos');
            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_asignacion')->references('id')->on('asignaciones');

            $table->foreign('id_visita')->references('id')->on('visitas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seguimientos');
    }
};
