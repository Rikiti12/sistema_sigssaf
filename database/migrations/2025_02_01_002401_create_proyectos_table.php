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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_pro');
            $table->text('descripcion_pro');
            $table->enum('tipo_pro', ['Infraestructura', 'Social', 'Educativo', 'Salud', 'Ambiental', 'Otro']);
            // $table->text('actividades');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->enum('prioridad', ['Alta', 'Media', 'Baja']);
            $table->json('acta_conformidad');
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
        Schema::dropIfExists('proyectos');
    }
};
