<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AvaliacaoController extends Controller
{
    public function downloadAvaliacoes()
    {
        $filename = 'avaliacoes.csv';

        $avaliacoes = Avaliacao::with('usuario', 'filme')->cursor();

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($avaliacoes) {
            $file = fopen('php://output', 'w');

            $header = [
                "ID Avaliação", "Usuário", "Filme", "Nota", "Comentário", "Status",
                "Data Criação", "Data Atualização"
            ];

            $headerISO = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $headerISO, ';');

            foreach ($avaliacoes as $avaliacao) {
                $nomeUsuario = $avaliacao->usuario->nome ?? '[Usuário Deletado]';
                $nomeFilme = $avaliacao->filme->nome ?? '[Filme Deletado]';

                $row = [
                    $avaliacao->id,
                    mb_convert_encoding($nomeUsuario, 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($nomeFilme, 'ISO-8859-1', 'UTF-8'),
                    $avaliacao->nota,
                    mb_convert_encoding($avaliacao->comentario ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($avaliacao->status ?? 'Ativo', 'ISO-8859-1', 'UTF-8'),
                    $avaliacao->created_at ? $avaliacao->created_at->format('Y-m-d H:i:s') : '',
                    $avaliacao->updated_at ? $avaliacao->updated_at->format('Y-m-d H:i:s') : '',
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avaliacoes = Avaliacao::with('usuario', 'filme')->get();
        return view('admin.avaliacoes')->with('avaliacoes', $avaliacoes);
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

        return response()->json([
            'success' => true,
            'message' => 'Avaliação salva com sucesso!',
            'data' => $avaliacao
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(Avaliacao $avaliacao)
    {
        return response()->json($avaliacao->load('filme', 'usuario'), 200);
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

        return response()->json([
            'success' => true,
            'message' => 'Avaliação editada com sucesso!',
            'data' => $avaliacao
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Avaliacao $avaliacao)
    {
        $avaliacao->update([
            'status' => 'deletado',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Avaliação excluída com sucesso!',
            'data' => $avaliacao
        ], 200);
    }

    public function reactivateAPI(Avaliacao $avaliacao)
    {
        $avaliacao->update(
            ['status' => 'ativo']
        );

        return response()->json([
            'success' => true,
            'message' => 'Avaliação reativada com sucesso!',
            'data' => $avaliacao
        ], 200);
    }
}
