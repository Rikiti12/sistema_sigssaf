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
        Schema::create('ayuda_sociales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_ayu');
            $table->text('descripcion');
            $table->unsignedBigInteger('id_persona'); // Clave foránea a la tabla personas
            $table->timestamps();

            // Definición de la clave foránea
            $table->foreign('id_persona')->references('id')->on('personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ayuda_sociales');
    }
};
