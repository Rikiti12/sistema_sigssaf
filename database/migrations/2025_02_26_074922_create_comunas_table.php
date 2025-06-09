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
        Schema::create('comunas', function (Blueprint $table) {
            $table->id();
            $table->string('nom_comunas');
            $table->bigInteger('id_parroquia')->nullable();
            $table->unsignedBigInteger('id_consejo');
            $table->text('dire_comunas');
            
            $table->timestamps();

            // Establecer relación con la tabla de parroquias
            $table->foreign('id_parroquia')->references('id')->on('parroquias');

            // Establecer relación con la tabla de parroquias
            $table->foreign('id_consejo')->references('id')->on('consejo_comunals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comunas');
    }
};
