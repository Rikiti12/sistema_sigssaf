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
        Schema::create('consejo_comunals', function (Blueprint $table) {
            $table->id();
            $table->string('cedula_voce')->unique();
            $table->string('nom_voce');
            $table->string('ape_voce');
            $table->string('telefono');
            $table->string('codigo_situr')->unique();
            $table->string('rif')->unique();
            $table->string('acta');
            $table->text('dire_consejo');
            $table->unsignedBigInteger('id_comunidad');

            // Establecer relación con la tabla de comunas
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
        Schema::dropIfExists('consejo_comunals');
    }
};
