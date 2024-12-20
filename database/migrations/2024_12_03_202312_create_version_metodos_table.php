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
        Schema::create('version_metodos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_metodo');
            $table->foreign('id_metodo')->references('id')->on('metodos')->delete('cascade');
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
        Schema::dropIfExists('version_metodos');
    }
};
