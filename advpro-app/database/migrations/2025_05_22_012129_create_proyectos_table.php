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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('fecha_inicio');
            $table->string('fecha_fin');
            $table->string('presupuesto');
            $table->string('estado');
            $table->string('lugar');
            $table->unsignedBigInteger('responsable')->nullable();
            $table->timestamps();
            $table->foreign('responsable')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
