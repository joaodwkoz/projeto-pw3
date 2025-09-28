<?php

use App\Http\Controllers\UsuarioController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('dashboard/contatos')->group(function () {
    Route::post('/', 'App\\Http\\Controllers\\ContatoController@storeApi');
});

Route::prefix('dashboard/usuarios')->group(function () {
    Route::post('/', [UsuarioController::class, 'storeAPI']);
    Route::get('/{usuario}', [UsuarioController::class, 'showAPI']);
    Route::put('/{usuario}', [UsuarioController::class, 'updateAPI']);
    Route::delete('/{usuario}', [UsuarioController::class, 'destroyAPI']);
});

Route::prefix('dashboard/filmes')->group(function () {
    Route::post('/', [App\Http\Controllers\FilmeController::class, 'storeAPI']);
    Route::get('/{filme}', [App\Http\Controllers\FilmeController::class, 'showAPI']);
    Route::put('/{filme}', [App\Http\Controllers\FilmeController::class, 'updateAPI']);
    Route::delete('/{filme}', [App\Http\Controllers\FilmeController::class, 'destroyAPI']);
});

Route::prefix('avaliacoes')->group(function () {
    Route::post('/', [App\Http\Controllers\AvaliacaoController::class, 'storeAPI']);
    Route::get('/{avaliacao}', [App\Http\Controllers\AvaliacaoController::class, 'showAPI']);
    Route::put('/{avaliacao}', [App\Http\Controllers\AvaliacaoController::class, 'updateAPI']);
    Route::delete('/{avaliacao}', [App\Http\Controllers\AvaliacaoController::class, 'destroyAPI']);
});

Route::prefix('listas')->group(function () {
    Route::post('/', [App\Http\Controllers\ListaController::class, 'storeAPI']);
    Route::get('/{lista}', [App\Http\Controllers\ListaController::class, 'showAPI']);
    Route::put('/{lista}', [App\Http\Controllers\ListaController::class, 'updateAPI']);
    Route::delete('/{lista}', [App\Http\Controllers\ListaController::class, 'destroyAPI']);
    Route::post('/{lista}/filme', [App\Http\Controllers\ListaController::class, 'adicionarFilme']);
    Route::delete('/{lista}/filme', [App\Http\Controllers\ListaController::class, 'removerFilme']);
});