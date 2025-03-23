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
            $table->string('nombre_pro');
            $table->text('descripcion_pro');
            $table->unsignedBigInteger('id_persona');
            $table->unsignedBigInteger('id_comunidad'); 
            $table->date('fecha_inicial');
            $table->timestamps();


            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_persona')->references('id')->on('personas');

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
        Schema::dropIfExists('planificaciones');
    }
};
