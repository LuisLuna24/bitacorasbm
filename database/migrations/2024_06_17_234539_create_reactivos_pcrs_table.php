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
        Schema::create('reactivos_pcrs', function (Blueprint $table) {
            $table->id();
            $table->integer('version')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('pcr_id');
            $table->foreign('pcr_id')->references('id')->on('pcrs')->onDelete('cascade');
            $table->unsignedBigInteger('reactivo_id');
            $table->foreign('reactivo_id')->references('id')->on('reactivos')->onDelete('cascade');
            $table->date('fecha_apertura')->nullable();
            $table->string('validacion')->default('Sin Validación');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactivos_pcrs');
    }
};
