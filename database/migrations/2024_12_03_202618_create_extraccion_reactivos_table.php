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
        Schema::create('extraccion_reactivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bit_reactivo');
            $table->foreign('id_bit_reactivo')->references('id')->on('bit_reactivos');
            $table->unsignedBigInteger('id_extraccion');
            $table->foreign('id_extraccion')->references('id')->on('extraccions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extraccion_reactivos');
    }
};
