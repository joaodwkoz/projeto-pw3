<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'nome' => 'João Pedro',
            'email' => 'joao.pedro@example.com',
            'senha' => Hash::make('12345678'),
            'ehAdmin' => false,
            'status' => 'ativo',
        ]);
        
        Usuario::create([
            'nome' => 'Administrador',
            'email' => 'admin@admin.com',
            'senha' => Hash::make('12345678'),
            'ehAdmin' => true,
            'status' => 'ativo',
        ]);
    }
}
