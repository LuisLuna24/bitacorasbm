<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('extraccion_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_extraccion');
            $table->foreign('id_extraccion')->references('id')->on('extraccions');
            $table->unsignedBigInteger('id_equipo');
            $table->foreign('id_equipo')->references('id')->on('equipos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extraccion_equipos');
    }
};
