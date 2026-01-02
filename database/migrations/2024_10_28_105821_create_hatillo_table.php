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
        Schema::create('hatillo', function (Blueprint $table) {
            $table->id();
            $table->string('linea', 10);
            $table->string('estado', 20);
            $table->string('titular', 100)->nullable();
            $table->string('inventario', 50)->nullable();
            $table->string('serial', 50)->nullable();
            $table->string('mac', 50)->nullable();
            $table->string('piso', 15)->nullable();
            $table->string('ephone', 3)->nullable();
            $table->string('dn',3)->nullable();
            $table->string('observacion', 255)->nullable();
            $table->string('modificado', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hatillo');
    }
};
