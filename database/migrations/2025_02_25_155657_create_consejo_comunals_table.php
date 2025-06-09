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
            $table->string('nom_consej');
            $table->string('situr')->unique();
            $table->string('rif')->unique();
            $table->string('acta');
            $table->text('dire_consejo');
            $table->unsignedBigInteger('id_vocero');
            $table->unsignedBigInteger('id_comunidad');

            // Establecer relación con la tabla de voceros
            $table->foreign('id_vocero')->references('id')->on('voceros');

            // Establecer relación con la tabla de comunidades
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
