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
        Schema::create('control_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_seguimiento');
            $table->timestamps();

            // Establecer relaciones con las tablas correspondientes
            $table->foreign('id_seguimiento')->references('id')->on('seguimientos');
        });
    }

     

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_seguimientos');
    }
};
