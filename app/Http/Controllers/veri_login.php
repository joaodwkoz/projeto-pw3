<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class veri_login extends Controller
{


    public function login(Request $request)
    {
        // validação básica
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:6',
        ]);

        $usuario = Usuario ::where('email', $request->email)->first();

        if ($usuario && Hash::check($request->senha, $usuario->senha)) {

            Auth::login($usuario);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha inválidos.',
        ]);
    }
}


