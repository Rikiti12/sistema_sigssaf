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
            $table->bigInteger('id_parroquia')->nullable();
            $table->string('nombre_pro');
            $table->text('descripcion_pro');
            $table->enum('tipo_pro', ['Infraestructura', 'Social', 'Educativo', 'Salud', 'Ambiental', 'Otro']);
            $table->text('actividades');
            $table->unsignedInteger('cantidad_bene')->nullable();
            $table->unsignedBigInteger('id_ayuda');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->enum('prioridad', ['Alta', 'Media', 'Baja']);
            $table->json('acta_conformidad');
            $table->timestamps();

            // Establecer relación con la tabla de ayudas
            $table->foreign('id_ayuda')->references('id')->on('ayudas');

            // Establecer relación con la tabla de ayudas
            $table->foreign('id_parroquia')->references('id')->on('parroquias');

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
