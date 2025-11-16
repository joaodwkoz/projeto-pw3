<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email');
            $table->enum('assunto', ['sugestao', 'duvida', 'problema', 'denuncia'])->default('sugestao');
            $table->string('mensagem');
            $table->enum('status', ['pendente', 'resolvido', 'nao_resolvido'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contatos');
    }
};