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
    Route::put('/{usuario}', [UsuarioController::class, 'updateAPI']);
    Route::delete('/{usuario}', [UsuarioController::class, 'destroyAPI']);
});

Route::prefix('dashboard/filmes')->group(function () {
    Route::post('/', [App\Http\Controllers\FilmeController::class, 'storeAPI']);
});