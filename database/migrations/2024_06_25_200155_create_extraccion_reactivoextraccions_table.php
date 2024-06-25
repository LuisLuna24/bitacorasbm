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
        Schema::create('extraccion_reactivoextraccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('extraccion_id');
            $table->foreign('extraccion_id')->references('id')->on('extraccions');
            $table->unsignedBigInteger('reactivoextraccions_id');
            $table->foreign('reactivoextraccions_id')->references('id')->on('reactivoextraccions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extraccion_reactivoextraccions');
    }
};
