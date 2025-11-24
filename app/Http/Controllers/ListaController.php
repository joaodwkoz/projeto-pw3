<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Usuario;
use App\Models\Filme;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ListaController extends Controller
{
    public function downloadListas()
    {
        $filename = 'listas.csv';

        $listas = Lista::with('usuario')->withCount('filmes')->cursor();

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($listas) {
            $file = fopen('php://output', 'w');

            $header = [
                "ID Lista", "Nome da Lista", "Descrição", "Dono (Usuário)", 
                "Qtd. Filmes", "Status", "Data Criação", "Data Atualização"
            ];

            $headerISO = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $headerISO, ';');

            foreach ($listas as $lista) {
                $nomeUsuario = $lista->usuario->nome ?? '[Usuário Deletado]';

                $row = [
                    $lista->id,
                    mb_convert_encoding($lista->nome ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($lista->descricao ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($nomeUsuario, 'ISO-8859-1', 'UTF-8'),
                    $lista->filmes_count,
                    mb_convert_encoding($lista->status ?? 'Ativo', 'ISO-8859-1', 'UTF-8'),
                    $lista->created_at ? $lista->created_at->format('Y-m-d H:i:s') : '',
                    $lista->updated_at ? $lista->updated_at->format('Y-m-d H:i:s') : '',
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

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
        $listas = Lista::with('filmes', 'usuario')->get();
        return view('admin.listas')->with('listas', $listas);
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

        return response()->json([
            'success' => true,
            'message' => 'Lista salva com sucesso!',
            'data' => $lista
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function showAPI(Lista $lista)
    {
        return response()->json($lista->load('filmes', 'usuario'), 200);
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

        return response()->json([
            'success' => true,
            'message' => 'Lista editada com sucesso!',
            'data' => $lista
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Lista $lista)
    {
        $lista->update(
            ['status' => 'deletado']
        );

        return response()->json([
            'success' => true,
            'message' => 'Lista excluída com sucesso!',
            'data' => $lista
        ], 200);
    }

    public function reactivateAPI(Lista $lista)
    {
        $lista->update(
            ['status' => 'ativo']
        );

        return response()->json([
            'success' => true,
            'message' => 'Lista reativada com sucesso!',
            'data' => $lista
        ], 200);
    }
    
    public function downloadPDFUsuarios()
    {
        $usuario = Lista::all();
        $dados = compact('lista');
        $pdf = Pdf::loadView('lista_pdf', $dados);
        return $pdf->download('lista.pdf');
    }
}
