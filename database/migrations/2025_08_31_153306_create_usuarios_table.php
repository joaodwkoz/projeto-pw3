<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha'); // senha criptografada
            $table->boolean('ehAdmin')->default(false);
            $table->string('status')->default('ativo');
            $table->string('fotoPerfil')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
