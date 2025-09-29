<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classificacao;

class ClassificacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classificacao::create(['nome' => 'Livre', 'descricao' => 'Conteúdo apropriado para todas as idades.']);
        Classificacao::create(['nome' => '10 anos', 'descricao' => 'Conteúdo apropriado para maiores de 10 anos.']);
        Classificacao::create(['nome' => '12 anos', 'descricao' => 'Conteúdo apropriado para maiores de 12 anos.']);
        Classificacao::create(['nome' => '14 anos', 'descricao' => 'Conteúdo apropriado para maiores de 14 anos.']);
        Classificacao::create(['nome' => '16 anos', 'descricao' => 'Conteúdo apropriado para maiores de 16 anos.']);
        Classificacao::create(['nome' => '18 anos', 'descricao' => 'Conteúdo apropriado para maiores de 18 anos.']);
    }
}
