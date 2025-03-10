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
        Schema::create('comunidades', function (Blueprint $table) {
            $table->id();
            $table->string('cedula_jefe')->unique();
            $table->string('nom_jefe');
            $table->string('ape_jefe');
            $table->string('telefono');
            $table->string('nom_comuni')->unique();
            $table->text('dire_comuni');
            $table->unsignedBigInteger('id_comuna');

            $table->timestamps();

            // Establecer relación con la tabla de comunas
            $table->foreign('id_comuna')->references('id')->on('comunas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunidades');
    }
};
