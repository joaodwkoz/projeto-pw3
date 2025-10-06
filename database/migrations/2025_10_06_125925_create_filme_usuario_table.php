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
        Schema::create('filme_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filme_id');
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('filme_id')->references('id')->on('filmes')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->unique(['filme_id', 'usuario_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filme_usuario');
    }
};