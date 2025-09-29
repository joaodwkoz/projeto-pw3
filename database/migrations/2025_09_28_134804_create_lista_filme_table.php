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
        Schema::create('lista_filme', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lista_id');
            $table->unsignedBigInteger('filme_id');
            $table->foreign('lista_id')->references('id')->on('listas')->onDelete('cascade');
            $table->foreign('filme_id')->references('id')->on('filmes')->onDelete('cascade');
            $table->unique(['lista_id', 'filme_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_filme');
    }
};
