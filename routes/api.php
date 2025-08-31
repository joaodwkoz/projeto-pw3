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

/* Routes API Contatos */

Route::post('/dashboard/contatos', 'App\Http\Controllers\ContatoController@storeApi');

/* Routes API Usuarios */

Route::post('/dashboard/usuarios', [UsuarioController::class, 'storeAPI']);
Route::delete('/dashboard/usuarios/{usuario}', [UsuarioController::class, 'destroyAPI']);
Route::put('/dashboard/usuarios/{usuario}', [UsuarioController::class, 'updateAPI']);