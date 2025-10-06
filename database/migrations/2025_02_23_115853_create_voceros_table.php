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
        Schema::create('voceros', function (Blueprint $table) {
            $table->id();
            $table->string('cedula')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->date('fecha_nacimiento');
            $table->integer('edad'); 
            $table->string('genero');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->text('direccion');
            $table->unsignedBigInteger('id_cargo');
            $table->string('tipo_vocero');
            $table->timestamps();

            // Establecer relación con la tabla de cargos
            $table->foreign('id_cargo')->references('id')->on('cargos');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voceros');
    }
};
