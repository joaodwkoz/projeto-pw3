<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Http\Controllers\Controller;
use App\Models\Classificacao;
use App\Models\Genero;
use App\Services\AtividadeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class FilmeController extends Controller
{
    public function downloadFilmes()
    {
        $filename = 'filmes.csv';

        $filmes = Filme::with('classificacao', 'generos')
                        ->withCount('listas', 'usuariosQueAssistiram')
                        ->withAvg('avaliacoes', 'nota')
                        ->cursor();

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($filmes) {
            $file = fopen('php://output', 'w');

            $header = [
                "ID", "Nome", "Diretor", "Ano Lançamento", "Classificação", "Gêneros",
                "Nota Média", "Sinopse", "Trailer", "Capa", "Status",
                "Qtd. em Listas", "Qtd. Assistiram", "Data Criação", "Data Atualização"
            ];

            $headerISO = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $headerISO, ';');

            foreach ($filmes as $filme) {
                $classificacao = $filme->classificacao->nome ?? '[N/A]';
                
                $generos = $filme->generos->pluck('nome')->implode(', ');

                $notaMedia = $filme->avaliacoes_avg_nota ? 
                            number_format($filme->avaliacoes_avg_nota, 1, ',', '.') : 
                            'N/A';
                
                $status = $filme->showStatusHTML();

                $row = [
                    $filme->id,
                    mb_convert_encoding($filme->nome ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($filme->diretor ?? '', 'ISO-8859-1', 'UTF-8'),
                    $filme->ano_lancamento,
                    mb_convert_encoding($classificacao, 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($generos, 'ISO-8859-1', 'UTF-8'),
                    $notaMedia,
                    mb_convert_encoding($filme->sinopse ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($filme->trailer ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($filme->capa ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($status, 'ISO-8859-1', 'UTF-8'),
                    $filme->listas_count,
                    $filme->usuarios_que_assistiram_count,
                    $filme->created_at ? $filme->created_at->format('Y-m-d H:i:s') : '',
                    $filme->updated_at ? $filme->updated_at->format('Y-m-d H:i:s') : '',
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function downloadPDFFilme()
    {
        // Método Original - Usa a view 'filme_pdf'
        $filme = Filme::all();
        $dados = compact('filme');
        $pdf = Pdf::loadView('filme_pdf', $dados);
        return $pdf->download('filme.pdf');
    }
    
    /**
     * NOVO MÉTODO: Gera PDF usando a view 'resources/views/pdf/filmes.blade.php'.
     */
    public function downloadPdfFilmesView()
    {
        $filmes = Filme::all(); 
        $dados = compact('filmes'); // Use 'filmes' no Blade para iterar
        
        // Carrega a view CORRETA: 'pdf.filmes'
        $pdf = Pdf::loadView('pdf.filmes', $dados); 
        
        return $pdf->download('relatorio-listagem-filmes.pdf');
    }

    // ... (restante dos seus métodos) ...

    public function marcarComoAssistido(Request $request, Filme $filme)
    {
        $jaAssistido = $filme->usuariosQueAssistiram()->where('usuario_id', $request->usuario_id)->exists();

        if ($jaAssistido) {
            return response()->json(['message' => 'Você já marcou esse filme como assistido'], 409);
        }

        $filme->usuariosQueAssistiram()->attach($request->usuario_id);

            AtividadeService::registrar(
                usuarioId: $request->usuario_id,
                nome: "Assistiu um filme",
                descricao: "Marcou como assistido",
                entidade: $filme,
                propriedades: [
                    'filme_nome' => $filme->nome
                ]
            );

        return response()->json(['sucesso' => true], 200);
    }

    public function desmarcarComoAssistido(Request $request, Filme $filme)
    {
        $jaAssistido = $filme->usuariosQueAssistiram()->where('usuario_id', $request->usuario_id)->exists();

        if (!$jaAssistido) {
            return response()->json(['message' => 'Você não marcou esse filme como assistido'], 409);
        }

        $filme->usuariosQueAssistiram()->detach($request->usuario_id);

          AtividadeService::registrar(
                usuarioId: $request->usuario_id,
                nome: "Desmarcou filme",
                descricao: "Desmarcou filme",
                entidade: $filme,
                propriedades: [
                    'filme_nome' => $filme->nome
                ]
            );

        return response()->json(['sucesso' => true], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filmePopulares = Filme::with('generos')->withAvg('avaliacoes', 'nota')->orderByDesc('avaliacoes_avg_nota')->take(10)->get();

        $recomendadosPorGenero = Filme::with('generos')->whereHas('generos', 
            function ($query) {
                $query->where('nome', 'Ação');
            })
        ->withAvg('avaliacoes', 'nota')->orderByDesc('avaliacoes_avg_nota')->take(10)->get();

        $filmes = Filme::with('generos')->withAvg('avaliacoes', 'nota')->orderByDesc('avaliacoes_avg_nota')->paginate(10);

        $generos = Genero::orderBy('nome')->get();

        return view('filmes')->with([
            'filmesPopulares' => $filmePopulares,
            'recomendadosPorGenero' => $recomendadosPorGenero,
            'filmes' => $filmes,
            'generos' => $generos,
        ]);
    }

    public function dashboardData()
    {
        $filmes = Filme::all()->load('generos', 'classificacao', 'avaliacoes');
        $classificacoes = Classificacao::all();
        $generos = Genero::all();

        return view('admin.filmes')->with(['filmes' => $filmes, 'classificacoes' => $classificacoes, 'generos' => $generos]);
    }

    public function all()
    {
        $filmes = Filme::with('generos')->withAvg('avaliacoes', 'nota')->orderByDesc('avaliacoes_avg_nota')->paginate(10);

        return $filmes;
    }

    public function fetchPorGenero(Genero $genero)
    {
        $filmes = $genero->filmes()->with('generos')->withAvg('avaliacoes', 'nota')->orderByDesc('avaliacoes_avg_nota')->take(10)->get();

        return response()->json($filmes);
    }

      public function generosMaisAssistidos()
    {
        $generosMaisAssistidos = \DB::table('filme_genero')
            ->join('filmes', 'filme_genero.filme_id', '=', 'filmes.id')
            ->join('generos', 'filme_genero.genero_id', '=', 'generos.id')
            ->join('filme_usuario_assistido', 'filme_usuario_assistido.filme_id', '=', 'filmes.id') // tabela pivô dos assistidos
            ->select('generos.nome', \DB::raw('COUNT(filme_usuario_assistido.usuario_id) as total_assistido'))
            ->groupBy('generos.id', 'generos.nome')
            ->orderByDesc('total_assistido')
            ->get();

        return response()->json($generosMaisAssistidos);
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
        $dados = $request->except(['capa', 'generos']);

        if($request->hasFile('capa')){
            $dados['capa'] = $request->file('capa')->store('filmes/capas', 'public');
        }

        $filme = Filme::create($dados);

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

    public function showFilmePage(Filme $filme)
    {
        $usuario = Auth::user();

        $jaAssistiu = $filme->usuariosQueAssistiram()->where('usuario_id', $usuario->id)->exists();

        return view('filme')->with(['filme' => $filme->load('generos', 'classificacao', 'avaliacoes.usuario'), 'assistido' => $jaAssistiu]);
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
       $dados = $request->except(['capa', 'banner', 'generos', '_method']);

        if($request->hasFile('capa')){
            Storage::disk('public')->delete($filme->capa);
            $dados['capa'] = $request->file('capa')->store('filmes/capas', 'public');
        }

        $filme->update($dados);

        if ($request->has('generos')) {
            $filme->generos()->sync($request->generos);
        }

        return response()->json([
            'success' => true,
            'message' => 'Filme editado com sucesso!',
            'data' => $filme
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAPI(Filme $filme)
    {
        $filme->update(
            ['status' => 'deletado']
        );

        return response()->json([
            'success' => true,
            'message' => 'Filme excluído com sucesso!',
            'data' => $filme
        ], 200);
    }

    public function reactivateAPI(Filme $filme)
    {
        $filme->update(
            ['status' => 'ativo']
        );

        return response()->json([
            'success' => true,
            'message' => 'Filme reativado com sucesso!',
            'data' => $filme
        ], 200);
    }

    
}