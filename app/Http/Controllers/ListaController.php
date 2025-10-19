<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Usuario;
use App\Models\Filme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListaController extends Controller
{
    public function obterListasUsuario(Usuario $usuario, Filme $filme)
    {
        $listas = $usuario->listas()->get();

        $listasComStatus = $listas->map(function ($lista) use ($filme) {
            $lista->is_checked = $lista->filmes()->where('filme_id', $filme->id)->exists();

            return $lista;
        });

        return response()->json($listasComStatus);
    }

    public function adicionarFilme(Request $request, Lista $lista)
    {
        $lista->filmes()->attach($request->filme_id);
        $lista->touch();
        return response()->json(['sucesso' => true], 201);
    }

    public function removerFilme(Request $request, Lista $lista)
    {
        $lista->filmes()->detach($request->filme_id);
        $lista->touch();
        return response()->json(['sucesso' => true], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Lista::all()->load('filmes');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAPI(Request $request)
    {
        $lista = Lista::create([
            'usuario_id' => $request->usuario_id,
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        return response()->json($lista, 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(Lista $lista)
    {
        return response()->json($lista->load('filmes'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lista $lista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAPI(Request $request, Lista $lista)
    {
        $lista->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        return response()->json($lista, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Lista $lista)
    {
        $lista->delete();
        return response()->json(['sucesso' => true], 200);
    }
}
