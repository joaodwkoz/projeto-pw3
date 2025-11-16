<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generos = Genero::with('filmes')->get();
        return view('admin.generos')->with('generos', $generos);
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
        $genero = Genero::create([
            'nome' => $request->nome,
            'cor' => strtoupper($request->cor),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gênero salvo com sucesso!',
            'data' => $genero
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(Genero $genero)
    {
        return response()->json($genero->load('filmes'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genero $genero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAPI(Request $request, Genero $genero)
    {
        $genero->update([
            'nome' => $request->nome,
            'cor' => strtoupper($request->cor),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gênero editado com sucesso!',
            'data' => $genero
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Genero $genero)
    {
        $genero->update([
            'status' => 'deletado',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Gênero excluído com sucesso!',
            'data' => $genero
        ], 200);
    }

    public function reactivateAPI(Genero $genero)
    {
        $genero->update(
            ['status' => 'ativo']
        );

        return response()->json([
            'success' => true,
            'message' => 'Gênero reativado com sucesso!',
            'data' => $genero
        ], 200);
    }
}
