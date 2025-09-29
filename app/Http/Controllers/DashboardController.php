<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $filmesEmAlta = ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'];

        $usuarios = [
            'labels' => ['João', 'Maria', 'Pedro', 'Ana', 'Lucas'],
            'data'   => [23, 45, 56, 12, 38]
        ];

        $generos = [
            ['name' => 'Ação', 'value' => 35],
            ['name' => 'Comédia', 'value' => 20],
            ['name' => 'Drama', 'value' => 15],
            ['name' => 'Terror', 'value' => 10],
            ['name' => 'Ficção', 'value' => 20],
        ];

        return view('dashboard.index', compact('filmesEmAlta', 'usuarios', 'generos'));
    }
}
