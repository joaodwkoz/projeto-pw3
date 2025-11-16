<?php

namespace App\Http\Controllers\Auth; // <-- O NAMESPACE DEVE SER ESTE

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Exibe o formulário de registro.
     * Mapeado para a rota GET /cadastro.
     * NÃO deve ter argumentos para ser chamado pela rota GET.
     */
    public function create() // <-- Deve estar VAZIO!
    {
        return view('auth.cadastro'); 
    }

    /**
     * Processa a submissão e salva o novo usuário.
     */
    public function store(RegisterRequest $request) 
    {
        User::create([ 
            'nome' => $request->name, 
            'email' => $request->email,
            'senha' => Hash::make($request->password), 
        ]);

        return redirect()->route('login')->with('mensagem', 'Cadastro realizado com sucesso! Faça login.');
    }
}