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
        Schema::create('linea_historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('linea_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('evento'); // 'created', 'updated', 'deleted'
            $table->string('nombre_campo')->nullable();
            $table->text('valor_anterior')->nullable();
            $table->text('valor_nuevo')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('linea_id')->references('id')->on('lineas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->index(['linea_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linea_historial');
    }
};
