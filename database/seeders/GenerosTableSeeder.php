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
        Genero::create(['nome' => 'Aventura']);
        Genero::create(['nome' => 'Comédia']);
        Genero::create(['nome' => 'Drama']);
        Genero::create(['nome' => 'Fantasia']);
        Genero::create(['nome' => 'Ficção C.']);
        Genero::create(['nome' => 'Romance']);
        Genero::create(['nome' => 'Suspense']);
        Genero::create(['nome' => 'Terror']);
    }
}
