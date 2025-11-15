<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genero;

class GenerosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genero::create(['nome' => 'Ação', 'cor' => '#FF6547']);
        Genero::create(['nome' => 'Aventura', 'cor' => '#A3FF63']);
        Genero::create(['nome' => 'Comédia', 'cor' => '#FFD930']);
        Genero::create(['nome' => 'Drama', 'cor' => '#C7C7C7']);
        Genero::create(['nome' => 'Fantasia', 'cor' => '#9E57F2']);
        Genero::create(['nome' => 'Ficção C.', 'cor' => '#61BBFA']);
        Genero::create(['nome' => 'Romance', 'cor' => '#FC77D9']);
        Genero::create(['nome' => 'Suspense', 'cor' => '#A64D00']);
        Genero::create(['nome' => 'Terror', 'cor' => '#820E0E']);
    }
}
