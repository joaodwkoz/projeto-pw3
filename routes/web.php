<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/contato', function () {
    return view('contato');
});

Route::get('/sla', function () {
    return view('sla');
});

Route::get('/perfil', function () {
    return view('perfil');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/filme', function () {
    return view('filme');
});

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');

Route::get('/dashboard/index', function () {
    return view('admin.index');
})->name('dashboard.index');

Route::get('/dashboard/usuarios', 'App\Http\Controllers\UsuarioController@index')->name('dashboard.usuarios');

Route::get('/dashboard/avaliacoes', function () {
    return view('admin.avaliacoes');
})->name('dashboard.avaliacoes');

Route::get('/dashboard/contatos', 'App\Http\Controllers\ContatoController@index')->name('dashboard.contatos');