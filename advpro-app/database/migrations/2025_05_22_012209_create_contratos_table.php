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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('id_cliente')->nullable();
            $table->unsignedBigInteger('id_proyecto')->nullable();
            $table->unsignedBigInteger('id_responsable')->nullable();
            $table->date('fecha_contrato');
            $table->string('tipo_contrato');
            $table->string('tiempo_contrato');
            $table->string('estado');
            $table->string('observaciones')->nullable();
            $table->string('documento')->nullable();
            $table->timestamps();
        });

        Schema::table('contratos', function (Blueprint $table) {
            $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('id_proyecto')->references('id')->on('proyectos')->onDelete('cascade');
            $table->foreign('id_responsable')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
