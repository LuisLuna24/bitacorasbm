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
        Schema::create('pcreal_equipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pcreal');
            $table->foreign('id_pcreal')->references('id')->on('pcreals');
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
        Schema::dropIfExists('pcreal_equipos');
    }
};
