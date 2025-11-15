<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Http\Controllers\Controller;
use App\Models\Classificacao;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Spatie\FlareClient\View;

class FilmeController extends Controller
{
    public function marcarComoAssistido(Request $request, Filme $filme)
    {
        $jaAssistido = $filme->usuariosQueAssistiram()->where('usuario_id', $request->usuario_id)->exists();

        if ($jaAssistido) {
            return response()->json(['message' => 'Você já marcou esse filme como assistido'], 409);
        }

        $filme->usuariosQueAssistiram()->attach($request->usuario_id);

        return response()->json(['sucesso' => true], 200);
    }

    public function desmarcarComoAssistido(Request $request, Filme $filme)
    {
        $jaAssistido = $filme->usuariosQueAssistiram()->where('usuario_id', $request->usuario_id)->exists();

        if (!$jaAssistido) {
            return response()->json(['message' => 'Você não marcou esse filme como assistido'], 409);
        }

        $filme->usuariosQueAssistiram()->detach($request->usuario_id);

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
