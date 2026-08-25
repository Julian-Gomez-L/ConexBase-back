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
        Schema::create('produccion', function (Blueprint $table) {
            $table->id()->unique();
            $table->date("fecha_inicio");
            $table->date("fecha_fin")->nullable();
            $table->string("estado", 50);
            $table->string("observaciones")->nullable();
            $table->timestamps();

            $table->unsignedBigInteger("pedido_id");
            $table->unsignedBigInteger("producto_id");
            $table->unsignedBigInteger("usuario_id");

            $table->foreign("pedido_id")->references("id")->on("pedido")->onDelete("cascade");
            $table->foreign("producto_id")->references("id")->on("producto")->onDelete("cascade");
            $table->foreign("usuario_id")->references("id")->on("usuario")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produccion');
    }
};
