<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.cadastro'); 
    }

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
