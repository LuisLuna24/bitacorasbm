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
        Schema::create('reactivopcrs', function (Blueprint $table) {
            $table->id();
            $table->integer('version')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('reactivo_id');
            $table->foreign('reactivo_id')->references('id')->on('reactivos')->onDelete('cascade');
            $table->date('fecha_apertura');
            $table->string('validacion')->default('Sin Validacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactivopcrs');
    }
};
