<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contato;
use App\Http\Requests\ContatoRequest;

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
        $validatedData = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255',
            'assunto' => 'required',
            'mensagem' => 'required',
        ]);

        Contato::create($validatedData);

        return response()->json(['message' => "Contato enviado com sucesso!"], 201);
    }

    public function store(ContatoRequest $request)
    {
        Contato::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'assunto'  => $request->assunto,
            'mensagem' => $request->mensagem,
        ]);
    }

}