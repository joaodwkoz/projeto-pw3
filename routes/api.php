<?php

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\GeneroController;
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
    Route::get('/', [ContatoController::class, 'all']);
    Route::post('/', [ContatoController::class, 'storeAPI']);
    Route::get('/{contato}', [ContatoController::class, 'showAPI']);
    Route::put('/{contato}/resolver', [ContatoController::class, 'resolveAPI']);
    Route::put('/{contato}/nao-resolver', [ContatoController::class, 'unresolveAPI']);
});

Route::get('filmes/genero/{genero}', [FilmeController::class, 'fetchPorGenero']);
Route::get('filmes/{filme}', [FilmeController::class, 'showAPI']);

Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'all']);
    Route::post('/', [UsuarioController::class, 'storeAPI']);
    Route::get('/buscar', [UsuarioController::class, 'buscar']);
    Route::put('/{usuario}/reativar', [UsuarioController::class, 'reactivateAPI']);
    Route::get('/{usuario}', [UsuarioController::class, 'showAPI']);
    Route::put('/{usuario}', [UsuarioController::class, 'updateAPI']);
    Route::delete('/{usuario}', [UsuarioController::class, 'destroyAPI']);
    Route::get('/{usuario}/listas/{filme}', [ListaController::class, 'obterListasUsuario']);
});

Route::prefix('avaliacoes')->group(function () {
    Route::get('/', [AvaliacaoController::class, 'all']);
    Route::post('/', [AvaliacaoController::class, 'storeAPI']);
    Route::get('/{avaliacao}', [AvaliacaoController::class, 'showAPI']);
    Route::put('/{avaliacao}', [AvaliacaoController::class, 'updateAPI']);
    Route::delete('/{avaliacao}', [AvaliacaoController::class, 'destroyAPI']);
});

Route::prefix('listas')->group(function () {
    Route::get('/', [ListaController::class, 'index']);
    Route::post('/', [ListaController::class, 'storeAPI']);
    Route::get('/{lista}', [ListaController::class, 'showAPI']);
    Route::put('/{lista}/reativar', [ListaController::class, 'reactivateAPI']);
    Route::put('/{lista}', [ListaController::class, 'updateAPI']);
    Route::delete('/{lista}', [ListaController::class, 'destroyAPI']);
    Route::post('/{lista}/filme', [ListaController::class, 'adicionarFilme']);
    Route::delete('/{lista}/filme', [ListaController::class, 'removerFilme']);
});

Route::prefix('filmes')->group(function () {
    Route::get('/', [FilmeController::class, 'all']);
    Route::get('/{filme}', [FilmeController::class, 'showAPI']);
    Route::post('/', [FilmeController::class, 'storeAPI']);
    Route::put('/{filme}/reativar', [FilmeController::class, 'reactivateAPI']);
    Route::put('/{filme}', [FilmeController::class, 'updateAPI']);
    Route::delete('/{filme}', [FilmeController::class, 'destroyAPI']);
    Route::post('/{filme}/marcar-como-assistido', [FilmeController::class, 'marcarComoAssistido']);
    Route::post('/{filme}/desmarcar-como-assistido', [FilmeController::class, 'desmarcarComoAssistido']);
});

Route::prefix('generos')->group(function () {
    Route::get('/', [GeneroController::class, 'all']);
    Route::get('/{genero}', [GeneroController::class, 'showAPI']);
    Route::post('/', [GeneroController::class, 'storeAPI']);
    Route::put('/{genero}/reativar', [GeneroController::class, 'reactivateAPI']);
    Route::put('/{genero}', [GeneroController::class, 'updateAPI']);
    Route::delete('/{genero}', [GeneroController::class, 'destroyAPI']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /* Lembra de arrumar rotas da api pro middleware is admin */
});

