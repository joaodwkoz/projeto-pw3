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

    public function storeAPI(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = Hash::make($request->senha);
        $usuario->ehAdmin = $request->ehAdmin;
        $usuario->status = $request->status;
        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function show(Usuario $usuario)
    {
        //
    }


    public function edit(Usuario $usuario)
    {
        //
    }

    public function updateAPI(Request $request, Usuario $usuario)
    {
        $usuario->nome = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->ehAdmin = $request->input('ehAdmin');
        $usuario->status = $request->input('status');

        $usuario->save();
        
        return response()->json($usuario, 200);
    }

    public function destroyAPI(Usuario $usuario)
    {
        $usuario->delete();
        return response()->json(['success' => true], 200);
    }
}
?>