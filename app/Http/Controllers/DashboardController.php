<<<<<<< HEAD
<?php
=======
<?php 
>>>>>>> main

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< HEAD
=======
use App\Models\Usuario;

use App\Models\Filme;

>>>>>>> main
class DashboardController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
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
=======
        $totalUsers = $this->usersCount();
        $totalMovies = $this->moviesCount();
        $topUsers = $this->usersWithMostMovies();
        $topMovies = $this->moviesWithMostReviews();

        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'totalMovies' => $totalMovies,
            'topUsers' => $topUsers,
            'topMovies' => $topMovies,
        ]);
    }

    private function usersCount() {
        return Usuario::count();
    }

    private function moviesCount() {
        return Filme::count();
    }

    private function usersWithMostMovies() {
        return Usuario::withCount('watchedMovies')->orderBy('watched_movies_count', 'desc')->take(5)->get();
    }

    private function moviesWithMostReviews() {
        return Filme::withCount('reviews')->orderBy('reviews_count', 'desc')->take(5)->get();
    }
}
?>
>>>>>>> main
