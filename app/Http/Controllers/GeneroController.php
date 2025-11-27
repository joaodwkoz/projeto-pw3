<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf; // ⬅️ Adicionado para geração de PDF

class GeneroController extends Controller
{
    public function downloadGeneros()
    {
        $filename = 'generos.csv';

        $generos = Genero::withCount('filmes')->cursor();

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($generos) {
            $file = fopen('php://output', 'w');

            $header = [
                "ID", "Nome", "Cor (Hex)", "Status", "Qtd. Filmes",
                "Data Criação", "Data Atualização"
            ];

            $headerISO = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $headerISO, ';');

            foreach ($generos as $genero) {
                $row = [
                    $genero->id,
                    mb_convert_encoding($genero->nome ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($genero->cor ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($genero->status ?? 'Ativo', 'ISO-8859-1', 'UTF-8'),
                    $genero->filmes_count,
                    $genero->created_at ? $genero->created_at->format('Y-m-d H:i:s') : '',
                    $genero->updated_at ? $genero->updated_at->format('Y-m-d H:i:s') : '',
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
    
    /**
     * NOVO MÉTODO: Gera PDF com a listagem de gêneros.
     * Usa a view Blade: resources/views/pdf/generos.blade.php (referenciada como 'pdf.generos')
     */
    public function downloadPdfGenerosView()
    {
        // 1. Busca os gêneros e a contagem de filmes (filmes_count)
        $generos = Genero::withCount('filmes')
                         ->orderBy('nome')
                         ->get();
        
        $dados = compact('generos'); 

        // 2. Carrega a view Blade 'pdf.generos'
        $pdf = Pdf::loadView('pdf.generos', $dados); 
        
        // 3. Retorna o download do arquivo
        return $pdf->download('relatorio-listagem-generos.pdf');
    }

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