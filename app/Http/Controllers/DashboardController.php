<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;

use App\Models\Filme;

class DashboardController extends Controller
{
    public function index()
    {
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