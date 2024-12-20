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
        Schema::create('version_analises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_analisis');
            $table->foreign('id_analisis')->references('id')->on('analises')->delete('cascade');
            $table->string('nombre',50);
            $table->string('nombre_anterior',50);
            $table->string('razon_cambio',255);
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('version_analises');
    }
};
