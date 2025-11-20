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
            $table->unsignedBigInteger('id_parroquia');
            $table->unsignedBigInteger('id_comunidad');
            $table->string('visita');
            $table->text('descripcion_vis');
             $table->json('evidencia');
    
            $table->foreign('id_parroquia')->references('id')->on('parroquias');
            $table->foreign('id_comunidad')->references('id')->on('comunidades');

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
        Schema::dropIfExists('visitas');
    }
};
