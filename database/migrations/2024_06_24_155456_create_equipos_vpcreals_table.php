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
        Schema::create('equipos_vpcreals', function (Blueprint $table) {
            $table->id();
            $table->integer('version')->default(1);  
            $table->unsignedBigInteger('equipos_id');
            $table->foreign('equipos_id')->references('id')->on('equipos');
            $table->unsignedBigInteger('vpcreals_id');
            $table->foreign('vpcreals_id')->references('id')->on('vpcreals');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos_vpcreals');
    }
};
