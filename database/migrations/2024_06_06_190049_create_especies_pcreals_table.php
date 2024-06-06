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
        Schema::create('especies_pcreal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('especies_id');
            $table->foreign('especies_id')->references('id')->on('especies')->onDelete('cascade');
            $table->unsignedBigInteger('pcreal_id');
            $table->foreign('pcreal_id')->references('id')->on('pcreals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies_pcreals');
    }
};
