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
        Schema::create('especies_pcr', function (Blueprint $table) {
            $table->id();
            $table->integer('version')->default(1);  
            $table->unsignedBigInteger('especies_id');
            $table->foreign('especies_id')->references('id')->on('especies')->onDelete('cascade');
            $table->unsignedBigInteger('pcr_id');
            $table->foreign('pcr_id')->references('id')->on('pcrs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies_pcr');
    }
};
