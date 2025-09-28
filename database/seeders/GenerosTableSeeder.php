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
        Genero::create(['nome' => 'Ação']);
        Genero::create(['nome' => 'Comédia']);
        Genero::create(['nome' => 'Drama']);
        Genero::create(['nome' => 'Fantasia']);
        Genero::create(['nome' => 'Ficção Científica']);
        Genero::create(['nome' => 'Romance']);
        Genero::create(['nome' => 'Terror']);
    }
}
