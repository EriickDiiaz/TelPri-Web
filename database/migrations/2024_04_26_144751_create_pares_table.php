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
        Schema::create('pares', function (Blueprint $table) {
            $table->id();
            $table->string('numero', 4);
            $table->string('estado', 20);
            $table->string('plataforma', 20)->nullable();            
            $table->foreignId('ubicacion_id')->constrained('ubicaciones')->onDelete('cascade')->onUpdate('cascade');
            $table->string('observaciones', 255)->nullable();
            $table->unique(['ubicacion_id', 'numero']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pares');
    }
};
