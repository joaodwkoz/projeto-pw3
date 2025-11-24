<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Filme;
use Illuminate\Support\Facades\DB; 
use App\Models\Genero;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = $this->usersCount();
        $totalMovies = $this->moviesCount();
        $topUsers = $this->usersWithMostMovies();
        $topMovies = $this->moviesWithMostReviews();
        $topGenres = $this->generosMaisAssistidos(); 
        $allGenres = $this->todosGeneros();

        return view('admin.index', [
            'totalUsers' => $totalUsers,
            'totalMovies' => $totalMovies,
            'topUsers' => $topUsers,
            'topMovies' => $topMovies,
            'topGenres' => $topGenres,
            'allGenres' => $allGenres,
        ]);
    }

    private function usersCount() {
        return Usuario::count();
    }

    private function moviesCount() {
        return Filme::count();
    }

    private function usersWithMostMovies() {
        return Usuario::withCount('filmesAssistidos')->orderBy('filmes_assistidos_count', 'desc')->take(5)->get();
    }

    private function moviesWithMostReviews() {
        return Filme::withCount('avaliacoes')->orderBy('avaliacoes_count', 'desc')->take(5)->get();
    }

  private function generosMaisAssistidos()
{
    return DB::table('generos')
        ->leftJoin('filme_genero', 'generos.id', '=', 'filme_genero.genero_id')
        ->leftJoin('filmes', 'filme_genero.filme_id', '=', 'filmes.id')
        ->leftJoin('avaliacoes', 'filmes.id', '=', 'avaliacoes.filme_id')
        ->select('generos.nome', DB::raw('COUNT(avaliacoes.usuario_id) as total_assistido'))
        ->groupBy('generos.id', 'generos.nome')
        ->orderByDesc('total_assistido')
        ->take(5)
        ->get()
        ->map(function($item) {
            return [
                'nome' => $item->nome,
                'total_assistido' => (int) $item->total_assistido, // garante número
            ];
        })
        ->toArray();
}

private function todosGeneros()
{
    return DB::table('generos')
        ->leftJoin('filme_genero', 'generos.id', '=', 'filme_genero.genero_id')
        ->leftJoin('filmes', 'filme_genero.filme_id', '=', 'filmes.id')
        ->leftJoin('avaliacoes', 'filmes.id', '=', 'avaliacoes.filme_id')
        ->select('generos.id', 'generos.nome', DB::raw('COUNT(avaliacoes.id) as total_assistido'))
        ->groupBy('generos.id', 'generos.nome')
        ->orderBy('generos.nome')
        ->get();
}



}
