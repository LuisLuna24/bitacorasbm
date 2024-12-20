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
        Schema::create('pcr_validacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pcr');
            $table->foreign('id_pcr')->references('id')->on('pcrs');
            $table->integer('validacion');
            $table->string('observaciones', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pcr_validacions');
    }
};
