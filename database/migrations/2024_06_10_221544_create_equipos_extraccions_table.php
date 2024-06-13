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
        Schema::create('equipos_extraccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipos_id');
            $table->foreign('equipos_id')->references('id')->on('equipos')->onDelete('cascade');
            $table->unsignedBigInteger('extraccion_id');
            $table->foreign('extraccion_id')->references('id')->on('extraccions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_extraccions');
    }
};
