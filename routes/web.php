<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Importe todos os controllers que você usa
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController; // Importante adicionar
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContatoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes(['register' => false]);

Route::get('/cadastro', function () {
    return view('auth.cadastro');
})->name('cadastro');

Route::post('/cadastro', [RegisterController::class, 'register'])->name('register');

Route::get('/', function () {
    return redirect()->route('filmes');
});

Route::get('/contato', function () {
    return view('contato');
});

Route::middleware('auth')->group(function () {
    Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes');

    Route::get('/perfil', function () {
        return view('perfil');
    })->name('perfil');

    Route::get('/filme', function () {
        return view('filme');
    })->name('filme');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/dashboard/usuarios', [UsuarioController::class, 'index'])->name('dashboard.usuarios');

    Route::get('/dashboard/avaliacoes', function () {
        return view('admin.avaliacoes');
    })->name('dashboard.avaliacoes');

    Route::get('/dashboard/contatos', [ContatoController::class, 'index'])->name('dashboard.contatos');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});