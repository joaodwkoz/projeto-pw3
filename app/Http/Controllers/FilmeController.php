<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Http\Controllers\Controller;
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
        $dados = $request->except(['capa', 'banner', 'generos']);

        if($request->hasFile('capa')){
            $dados['capa'] = $request->file('capa')->store('filmes/capas', 'public');
        }

        if($request->hasFile('banner')){
            $dados['banner'] = $request->file('banner')->store('filmes/banners', 'public');
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

        if($request->hasFile('banner')){
            Storage::disk('public')->delete($filme->banner);
            $dados['banner'] = $request->file('banner')->store('filmes/banners', 'public');
        }

        $filme->update($dados);

        if ($request->has('generos')) {
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

    public function buscarFilme(Request $request) {
        $titulo = $request->input('titulo');

        if (!$titulo) {
            return response()->json(['erro' => 'Título não informado'], 400);
        }

        $response = Http::get(env('OMDB_API_URL'), [
            'apikey' => env('OMDB_API_KEY'),
            't' => $titulo,
            'plot' => 'full'
        ]);

        if (!$response->successful()) {
            return response()->json(['erro' => 'Erro ao acessar a API OMDB'], 500);
        }

        $dados = $response->json();

        if ($dados['Response'] === 'False') {
            return response()->json(['erro' => 'Filme não encontrado'], 404);
        }

        return response()->json($dados);
    }
}
