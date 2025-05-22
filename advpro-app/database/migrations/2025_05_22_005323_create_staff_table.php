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
        Schema::create('staff', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('documento')->unique();
            $table->string("tipo_documento");
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('direccion');
            $table->unsignedBigInteger('id_cargo')->nullable();
            $table->string('foto')->nullable();
            $table->tinyInteger('estado')->default(1);
            //$table->string('usuario')->unique();
            //$table->string('contrasena');
            //$table->string('rol')->default('empleado');
            //$table->string('token')->nullable();
            //$table->string('token_expiracion')->nullable();
            $table->timestamps();
        });
        // Luego agrega la FK en una operación separada
        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('id_cargo')
                ->references('id')
                ->on('cargos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
