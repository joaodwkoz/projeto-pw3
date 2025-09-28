<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Filme::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeAPI(Request $request)
    {
        $filme = Filme::create([
            'nome' => $request->nome,
            'diretor' => $request->diretor,
            'ano_lancamento' => $request->ano_lancamento,
            'classificacao_id' => $request->classificacao_id,
            'sinopse' => $request->sinopse,
            'trailer' => $request->trailer,
            'capa' => $request->capa,
            'banner' => $request->banner,
        ]);

        if($request->has('generos')){
            $filme->generos()->sync($request->generos);
        }

        return response()->json($filme, 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(Filme $filme)
    {
        return response()->json($filme->load('generos', 'classificacao', 'avaliacoes'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filme $filme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAPI(Request $request, Filme $filme)
    {
        $filme->update([
            'nome' => $request->nome,
            'diretor' => $request->diretor,
            'ano_lancamento' => $request->ano_lancamento,
            'classificacao_id' => $request->classificacao_id,
            'sinopse' => $request->sinopse,
            'trailer' => $request->trailer,
            'capa' => $request->capa,
            'banner' => $request->banner,
        ]);

        if($request->has('generos')){
            $filme->generos()->sync($request->generos);
        }

        return response()->json($filme, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Filme $filme)
    {
        $filme->delete();
        return response()->json(['sucesso' => true], 200);
    }
}
