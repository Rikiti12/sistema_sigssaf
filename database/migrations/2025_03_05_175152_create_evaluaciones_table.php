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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_proyecto'); 
            $table->unsignedBigInteger('id_resposanble');
            $table->date('fecha_evalu');
            $table->text('observaciones');
            $table->string('estatus');
            $table->string('estatus_resp')->nullable();
            $table->enum('viabilidad', ['Alta 100%', 'Media 50%', 'Baja 25%']);
            $table->timestamps();
            
             // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_proyecto')->references('id')->on('proyectos');

            $table->foreign('id_resposanble')->references('id')->on('resposanbles');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
};