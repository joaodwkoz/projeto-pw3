<?php

namespace App\Http\Controllers;

use App\Models\Usuario;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios')->with('usuarios', $usuarios);
    }

    public function create()
    {
        //
    }

    public function storeApi(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = Hash::make($request->senha);
        $usuario->created_at = date('Y-m-d H:i:s');
        $usuario->updated_at = date('Y-m-d H:i:s');

        $usuario->save();
    }

    public function show(Usuario $usuario)
    {
        //
    }


    public function edit(Usuario $usuario)
    {
        //
    }

    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    public function destroy(Usuario $usuario)
    {
        //
    }
}
?>