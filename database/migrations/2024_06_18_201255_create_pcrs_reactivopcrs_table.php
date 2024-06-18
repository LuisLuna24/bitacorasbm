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
        Schema::create('pcrs_reactivopcrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pcr_id');
            $table->foreign('pcr_id')->references('id')->on('pcrs')->onDelete('cascade');
            $table->unsignedBigInteger('reactivopcr_id');
            $table->foreign('reactivopcr_id')->references('id')->on('reactivopcrs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcrs_reactivopcrs');
    }
};
