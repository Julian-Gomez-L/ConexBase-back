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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('documento', 20)->unique(); // Documento de identidad
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('correo', 150)->unique(); // Correo electrónico
            $table->string('password', 255); // Usamos password para evitar la 'ñ'
            
            // Llave foránea conectada a la tabla roles
            $table->foreignId('rol_id')->constrained('roles');
            
            $table->boolean('estado')->default(true); // Estado activo/inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};