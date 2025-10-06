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

    public function all()
    {
        return Usuario::all();
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

    
    /**
     * Display the specified resource.
     */
    public function showAPI(Usuario $usuario)
    {
        return response()->json($usuario->load(['listas', 'avaliacoes']), 200);
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
        $usuario->update([
            'status' => 'Deletado'
        ]);

        return response()->json(['success' => true], 200);
    }

    public function buscar(Request $request) {
        $termo = $request->input('q');

        if(!$termo) {
            return response()->json(['erro' => 'Termo de busca não informado.'], 400);
        }

        $usuarios = Usuario::where('nome', 'like', "%{$termo}%")
        ->orWhere('email', 'like', "%{$termo}%")
        ->get();

        return response()->json($usuarios);
    }
}
?>