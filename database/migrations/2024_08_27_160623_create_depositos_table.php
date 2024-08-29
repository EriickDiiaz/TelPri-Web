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
        Schema::create('depositos', function (Blueprint $table) {
            $table->id();
            $table->string('inventario', 20)->unique();
            $table->string('serial', 50)->nullable();
            $table->string('marca', 15)->nullable();
            $table->string('modelo', 10)->nullable();            
            $table->string('ubicacion', 10)->nullable();
            $table->string('estado', 20);
            $table->string('modificado', 50)->nullable(); // Para quien realizó el último cambio
            $table->text('observacion')->nullable(); // Observaciones adicionales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depositos');
    }
};
