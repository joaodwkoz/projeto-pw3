<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ContatoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('contatos')->group(function () {
    Route::post('/', [ContatoController::class, 'storeAPI']);
});

Route::prefix('usuarios')->group(function () {
    Route::post('/', [UsuarioController::class, 'storeAPI']);
    Route::get('/buscar', [UsuarioController::class, 'buscar']);
    Route::get('/{usuario}', [UsuarioController::class, 'showAPI']);
    Route::put('/{usuario}', [UsuarioController::class, 'updateAPI']);
    Route::delete('/{usuario}', [UsuarioController::class, 'destroyAPI']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::prefix('avaliacoes')->group(function () {
        Route::post('/', [AvaliacaoController::class, 'storeAPI']);
        Route::get('/{avaliacao}', [AvaliacaoController::class, 'showAPI']);
        Route::put('/{avaliacao}', [AvaliacaoController::class, 'updateAPI']);
        Route::delete('/{avaliacao}', [AvaliacaoController::class, 'destroyAPI']);
    });

    Route::prefix('listas')->group(function () {
        Route::post('/', [ListaController::class, 'storeAPI']);
        Route::get('/{lista}', [ListaController::class, 'showAPI']);
        Route::put('/{lista}', [ListaController::class, 'updateAPI']);
        Route::delete('/{lista}', [ListaController::class, 'destroyAPI']);
        Route::post('/{lista}/filme', [ListaController::class, 'adicionarFilme']);
        Route::delete('/{lista}/filme', [ListaController::class, 'removerFilme']);
    });

    Route::prefix('filmes')->group(function () {
        Route::get('/genero/{genero}', [FilmeController::class, 'fetchPorGenero']);
        Route::get('/{filme}', [FilmeController::class, 'showAPI']);
        Route::post('/', [FilmeController::class, 'storeAPI']);
        Route::put('/{filme}', [FilmeController::class, 'updateAPI']);
        Route::delete('/{filme}', [FilmeController::class, 'destroyAPI']);
    });

    /* Lembra de arrumar rotas da api pro middleware is admin */
});