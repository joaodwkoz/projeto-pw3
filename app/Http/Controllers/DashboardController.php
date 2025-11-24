<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Filme;
use Barryvdh\DomPDF\Facade\Pdf;
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

        $atividades = \App\Models\AtividadeRecente::with('usuario')
        ->orderBy('created_at', 'desc')
        ->take(20)
        ->get();

        return view('admin.index', [
            'totalUsers' => $totalUsers,
            'totalMovies' => $totalMovies,
            'topUsers' => $topUsers,
            'topMovies' => $topMovies,
            'topGenres' => $topGenres,
            'allGenres' => $allGenres,
            'atividades' => $atividades
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
    
        public function downloadPDFDashboard()
    {
        $totalUsers = $this->usersCount();
        $totalMovies = $this->moviesCount();
        $topUsers = $this->usersWithMostMovies();
        $topMovies = $this->moviesWithMostReviews();
    
        $dados = compact('totalUsers', 'totalMovies', 'topUsers', 'topMovies');
        $pdf = Pdf::loadView('dashboard_pdf', $dados);
        return $pdf->download('dashboard.pdf');
    }

 private function generosMaisAssistidos()
{
    return DB::table('generos')
        ->leftJoin('filme_genero', 'generos.id', '=', 'filme_genero.genero_id')
        ->leftJoin('filmes', 'filme_genero.filme_id', '=', 'filmes.id')
        ->leftJoin('avaliacoes', 'filmes.id', '=', 'avaliacoes.filme_id')
        ->select('generos.nome', 'generos.cor', DB::raw('COUNT(avaliacoes.usuario_id) as total_assistido'))
        ->groupBy('generos.id', 'generos.nome', 'generos.cor')
        ->orderByDesc('total_assistido')
        ->take(5)
        ->get()
        ->map(function($item) {
            return [
                'nome' => $item->nome,
                'cor' => $item->cor,
                'total_assistido' => (int) $item->total_assistido,
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
        ->select('generos.id', 'generos.nome', 'generos.cor', DB::raw('COUNT(avaliacoes.id) as total_assistido'))
        ->groupBy('generos.id', 'generos.nome', 'generos.cor')
        ->orderBy('generos.nome')
        ->get();
}




}