<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Avaliacao::all();
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
        $avaliacao = Avaliacao::create([
            'usuario_id' => $request->usuario_id,
            'filme_id' => $request->filme_id,
            'nota' => $request->nota,
            'comentario' => $request->comentario,
        ]);

        return response()->json($avaliacao, 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(Avaliacao $avaliacao)
    {
        return response()->json($avaliacao, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avaliacao $avaliacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAPI(Request $request, Avaliacao $avaliacao)
    {
        $avaliacao->update([
            'nota' => $request->nota,
            'comentario' => $request->comentario,
        ]);

        return response()->json($avaliacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Avaliacao $avaliacao)
    {
        $avaliacao->delete();
        return response()->json(['sucesso' => true], 200);
    }
}
