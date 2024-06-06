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
        Schema::create('extraccions', function (Blueprint $table) {
            $table->id();
            $table->integer('version')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('no_registro',50);
            $table->date('fecha');
            $table->unsignedBigInteger('metodo_id');
            $table->foreign('metodo_id')->references('id')->on('metodos')->onDelete('cascade');
            $table->unsignedBigInteger('analisis_id');
            $table->foreign('analisis_id')->references('id')->on('analises')->onDelete('cascade');
            $table->string('conc_ng_ul',50);
            $table->string('dato260_280',50);
            $table->string('dato260_230',50);
            $table->string('validacion',30)->default('Sin Validacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extraccions');
    }
};
