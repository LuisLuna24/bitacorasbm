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
        Schema::create('version_reactivos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reactivo');
            $table->foreign('id_reactivo')->references('id')->on('reactivos')->onDelete('cascade');
            $table->string('lote',50);
            $table->string('lote_anterior',50);
            $table->string('nombre',100);
            $table->string('nombre_anterior',100);
            $table->string('descripcion',255);
            $table->string('descripcion_anterior',255);
            $table->integer('stock')->default(0);
            $table->integer('stock_anterior')->default(0);
            $table->date('caducidad');
            $table->date('caducidad_anterior');
            $table->string('razon_cambio',255);
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('version_reactivos');
    }
};
