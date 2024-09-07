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
        Schema::create('deposito_historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deposito_id'); // Relación con el equipo en la tabla depositos
            $table->string('campo_modificado', 50); // Campo que fue modificado
            $table->string('valor_anterior')->nullable(); // Valor anterior del campo
            $table->string('valor_nuevo'); // Nuevo valor del campo
            $table->unsignedBigInteger('usuario_id'); // Usuario que realizó el cambio
            $table->timestamps();

            // Foreign Keys
            $table->foreign('deposito_id')->references('id')->on('depositos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade'); // Relación con la tabla de usuarios
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposito_historial');
    }
};
