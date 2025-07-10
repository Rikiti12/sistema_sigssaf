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
            $table->unsignedBigInteger('id_planificacion');
            $table->dateTime('fecha_hor');
            $table->string('responsable_segui');
            $table->text('detalle_segui');
            $table->string('gasto'); 
            $table->string('estado_actual');
            $table->text('riesgos');
            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_planificacion')->references('id')->on('planificaciones');
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
