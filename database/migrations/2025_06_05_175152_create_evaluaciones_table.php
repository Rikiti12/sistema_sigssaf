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
            $table->date('fecha_evalu');
            $table->string('respon_evalu', 100);
            $table->text('observaciones');
            $table->string('estatus');
            $table->string('estatus_resp')->nullable();
            $table->enum('viabilidad', ['Alta', 'Media', 'Baja']);
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
        Schema::dropIfExists('evaluaciones');
    }
};