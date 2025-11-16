<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FilmeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\GeneroController;
use App\Models\Classificacao;
use App\Models\Genero;

/*
|--------------------------------------------------------------------------
| Rotas Web (Públicas e de Autenticação)
|--------------------------------------------------------------------------
*/

Auth::routes(['register' => false]);

Route::get('/cadastro', function () {
    return view('auth.cadastro');
})->name('cadastro');

Route::post('/cadastro', [RegisterController::class, 'register'])->name('register');

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/contato', function () {
    return view('contato');
})->name('contato');

Route::post('/contato', [ContatoController::class, 'store'])->name('contato.enviar');

Route::get('/listas', function () {
    return view('listas');
})->name('listas');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', function () {
        return view('usuario')->with('usuario', Auth::user());
    })->name('perfil');

    Route::get('/usuarios/{usuario}', [UsuarioController::class, 'showProfile'])->name('usuario.show');

    Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes');

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/sobre', function () {
        return view('sobre');
    })->name('sobre');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/filmes/{filme}', [FilmeController::class, 'showFilmePage'])->name('filmes.show');

    Route::middleware('is_admin')->prefix('dashboard')->group(function () { 
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('dashboard.usuarios');

        Route::get('/avaliacoes', [AvaliacaoController::class, 'index'])->name('dashboard.avaliacoes');

        Route::get('/contatos', [ContatoController::class, 'index'])->name('dashboard.contatos');

        Route::get('/filmes', [FilmeController::class, 'dashboardData'])->name('dashboard.filmes');

        Route::get('/generos', [GeneroController::class, 'index'])->name('dashboard.generos');
    });
});

Route::get('/download-csv', [AdminController::class, 'download'])->name('download.csv');