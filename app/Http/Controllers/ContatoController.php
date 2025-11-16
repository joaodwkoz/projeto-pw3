<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contato;

class ContatoController extends Controller
{
    public function index()
    {
        $contatos = Contato::all();
        return view('admin.contatos')->with('contatos', $contatos);
    }

    public function all()
    {
        return Contato::all();
    }

    public function storeAPI(Request $request)
    {
        $contato = Contato::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'assunto' => $request->assunto,
            'mensagem' => $request->mensagem,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contato salvo com sucesso!',
            'data' => $contato
        ], 201);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255',
            'assunto' => 'required',
            'mensagem' => 'required',
        ]);

        Contato::create($validatedData);

        return redirect()->back()->with('success', 'Sua mensagem foi enviada com sucesso!');
    }

    public function showAPI(Contato $contato)
    {
        return response()->json($contato, 200);
    }

    public function resolveAPI(Contato $contato)
    {
        $contato->update([
            'status' => 'resolvido',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Contato marcado como resolvido com sucesso!',
            'data' => $contato
        ], 200);
    }

    public function unresolveAPI(Contato $contato)
    {
        $contato->update([
            'status' => 'nao_resolvido',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Contato marcado como não resolvido com sucesso!',
            'data' => $contato
        ], 200);
    }
}