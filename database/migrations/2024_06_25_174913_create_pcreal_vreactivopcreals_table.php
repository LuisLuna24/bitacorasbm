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
        Schema::create('pcreal_vreactivopcreals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pcreal_id');
            $table->foreign('pcreal_id')->references('id')->on('pcreals');
            $table->unsignedBigInteger('vreactivopcreals_id');
            $table->foreign('vreactivopcreals_id')->references('id')->on('vreactivopcreals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcreal_vreactivopcreals');
    }
};
