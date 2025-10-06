<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\FilmeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ContatoController;

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

Route::get('/filmes', [FilmeController::class, 'index'])->name('filmes');

Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', function () {
        return view('perfil');
    })->name('perfil');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('is_admin')->prefix('dashboard')->group(function () { 
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('dashboard.usuarios');
        Route::get('/avaliacoes', function () {
            return view('admin.avaliacoes');
        })->name('dashboard.avaliacoes');
        Route::get('/contatos', [ContatoController::class, 'index'])->name('dashboard.contatos');
    });
});