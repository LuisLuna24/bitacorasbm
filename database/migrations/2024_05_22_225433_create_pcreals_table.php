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
        Schema::create('pcreals', function (Blueprint $table) {
            $table->id();
            $table->integer('version')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('no_registro',50);
            $table->date('fecha');
            $table->unsignedBigInteger('analisis_id');
            $table->foreign('analisis_id')->references('id')->on('analises')->onDelete('cascade');
            $table->boolean('sanitizo')->default(false);
            $table->boolean('tiempouv')->default(false);
            $table->string('resultado',30)->default('Negativo');
            $table->string('observaciones',250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcreals');
    }
};
