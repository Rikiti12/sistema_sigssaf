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
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_resposanble');
            $table->string('visita');
            $table->text('descripcion_vis');
            $table->date('fecha_visita');
            $table->json('foto_visita');
            $table->timestamps();

            // Establecer relación con la tabla de responsables
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
        Schema::dropIfExists('visitas');
    }
};
