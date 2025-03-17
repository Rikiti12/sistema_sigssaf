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
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->text('dire_vivie');
            $table->text('tipo_vivie'); 
            $table->bigInteger('id_persona')->nullable(); // Clave foránea a la tabla de personas
            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_persona')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('viviendas');
    }
};