<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contato;

use Barryvdh\DomPDF\Facade\Pdf;

class ContatoController extends Controller
{

    public function downloadPDFContato()
    {
        $contato = Contato::all();

        $dados = compact('contato');

        $pdf = Pdf::loadView('contato_pdf', $dados);

        return $pdf->download('contado.pdf');
    }
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
}