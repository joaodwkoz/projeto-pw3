<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClassificacoesTableSeeder::class,
            GenerosTableSeeder::class,
            UsuariosTableSeeder::class,
            FilmesTableSeeder::class,
            ListasTableSeeder::class,
            AvaliacoesTableSeeder::class,
        ]);
    }
}
