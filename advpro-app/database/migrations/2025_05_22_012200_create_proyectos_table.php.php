<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla 'proyectos' con sus columnas y claves foráneas.
     */
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('fecha_inicio'); // Considera usar $table->date()
            $table->string('fecha_fin');    // Considera usar $table->date()
            $table->string('presupuesto');  // Considera usar $table->decimal()
            $table->string('estado');
            $table->string('lugar');

            // === AÑADIDO: COLUMNA Y CLAVE FORÁNEA PARA EL CLIENTE ===
            // Esta columna 'cliente_id' es la que faltaba.
            // unsignedBigInteger es el tipo de dato para IDs de Laravel.
            $table->unsignedBigInteger('cliente_id');
            // Define la relación de clave foránea con la tabla 'clientes'.
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            // =======================================================

            // === CORREGIDO: COLUMNA RESPONSABLE A 'responsable_id' ===
            // Unificado el nombre para que coincida con el controlador y modelo.
            $table->unsignedBigInteger('responsable_id')->nullable();
            // Define la relación de clave foránea con la tabla 'staff'.
            $table->foreign('responsable_id')->references('id')->on('staff')->onDelete('cascade');
            // =======================================================

            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla 'proyectos', primero sus claves foráneas.
     */
    public function down(): void
    {
        // Es crucial eliminar primero las claves foráneas para evitar errores.
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']);      // Elimina la clave foránea de cliente
            $table->dropForeign(['responsable_id']); // Elimina la clave foránea de responsable
        });
        
        // Luego, elimina la tabla 'proyectos'.
        Schema::dropIfExists('proyectos');
    }
};