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
        Schema::create('pcr_reactivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_bit_reactivo');
            $table->foreign('id_bit_reactivo')->references('id')->on('bit_reactivos');
            $table->unsignedBigInteger('id_pcr');
            $table->foreign('id_pcr')->references('id')->on('pcrs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcr_reactivos');
    }
};
