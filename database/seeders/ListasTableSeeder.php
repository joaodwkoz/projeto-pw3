<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Lista;

class ListasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = Usuario::where('email', 'joao.pedro@example.com')->first();

        $lista = Lista::create([
            'usuario_id' => $usuario->id,
            'nome' => 'Filmes para Assistir',
            'descricao' => 'Uma lista de filmes que pretendo ver em breve.',
        ]);

        $lista->filmes()->attach([2, 3, 4]);
    }
}
