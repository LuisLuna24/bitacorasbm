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
        Schema::create('pcrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('id_analisis');
            $table->foreign('id_analisis')->references('id')->on('analises');
            $table->string('no_registro',50);
            $table->integer('sanitizo')->default(0);
            $table->integer('tiempouv')->default(0);
            $table->string('agaroza',50);
            $table->string('tiempo',50);
            $table->string('voltaje',50);
            $table->integer('version')->default(1);
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcrs');
    }
};
