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
        Schema::create('actividad_proyectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proyecto'); // Agregar columna de clave foránea
            $table->unsignedBigInteger('id_actividad'); // Agregar columna de clave foránea
            
            // Establecer relación con la tabla de comisionados
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
            // Establecer relación con la tabla de municipios
            $table->foreign('id_actividad')->references('id')->on('actividades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_proyectos');
    }
};
