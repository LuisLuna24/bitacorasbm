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
        Schema::create('pcr_especies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pcreal');
            $table->foreign('id_pcreal')->references('id')->on('pcreals');
            $table->unsignedBigInteger('id_especie');
            $table->foreign('id_especie')->references('id')->on('especies');
            $table->integer('resultado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcr_especies');
    }
};
