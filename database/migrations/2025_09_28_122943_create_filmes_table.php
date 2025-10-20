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
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('diretor');
            $table->integer('ano_lancamento');
            $table->unsignedBigInteger('classificacao_id');
            $table->text('sinopse');
            $table->string('trailer')->nullable();
            $table->string('capa')->nullable();
            $table->foreign('classificacao_id')->references('id')->on('classificacoes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
