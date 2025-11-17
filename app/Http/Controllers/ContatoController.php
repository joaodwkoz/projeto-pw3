<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contato;

use Illuminate\Support\Facades\Response;

class ContatoController extends Controller
{
    public function downloadContatos()
    {
        $filename = 'contatos.csv';

        $contatos = Contato::cursor();

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($contatos) {
            $file = fopen('php://output', 'w');

            $header = [
                "ID", "Nome", "Email", "Assunto", "Mensagem", "Status",
                "Data Envio", "Data Atualização"
            ];

            $headerISO = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $headerISO, ';');

            foreach ($contatos as $contato) {
                $assuntoTexto = $contato->showAssuntoHTML();
                $statusTexto = $contato->showStatusHTML();

                $row = [
                    $contato->id,
                    mb_convert_encoding($contato->nome ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($contato->email ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($assuntoTexto, 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($contato->mensagem ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($statusTexto, 'ISO-8859-1', 'UTF-8'),
                    $contato->created_at ? $contato->created_at->format('Y-m-d H:i:s') : '',
                    $contato->updated_at ? $contato->updated_at->format('Y-m-d H:i:s') : '',
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
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