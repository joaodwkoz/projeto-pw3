<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Avaliacao;

class AvaliacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = Usuario::where('email', 'joao.pedro@example.com')->first();

        Avaliacao::create([
            'usuario_id' => $usuario->id,
            'filme_id' => 1,
            'nota' => 5,
            'comentario' => 'Um filme incrível! A reviravolta no final é genial e as atuações são impecáveis.',
        ]);
    }
}