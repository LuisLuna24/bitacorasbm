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
            $table->integer('version')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('no_registro',50);
            $table->date('fecha');
            $table->unsignedBigInteger('analisis_id');
            $table->foreign('analisis_id')->references('id')->on('analises')->onDelete('cascade');
            $table->string('resultado',30)->default('Negativo');
            $table->string('agarosa',30)->nullable();
            $table->string('voltaje',30)->nullable();
            $table->string('tiempo',30)->nullable();
            $table->boolean('sanitizo')->default(0);
            $table->boolean('tiempouv')->default(0);
            $table->string('validacion',30)->default('Sin Validacion');
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
