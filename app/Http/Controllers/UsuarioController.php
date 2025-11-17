<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class UsuarioController extends Controller
{
    public function downloadUsuarios()
    {
        $filename = 'usuarios.csv';

        $usuarios = Usuario::cursor();

        $headers = [
            'Content-Type' => 'text/csv; charset=ISO-8859-1',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($usuarios) {
            $file = fopen('php://output', 'w');

            $header = [
                "ID", "Nome", "Email", "Foto Perfil", "É Admin", "Status",
                "Data Criação", "Data Atualização"
            ];

            $headerISO = array_map(fn($col) => mb_convert_encoding($col, 'ISO-8859-1', 'UTF-8'), $header);
            fputcsv($file, $headerISO, ';');

            foreach ($usuarios as $usuario) {
                $ehAdminTexto = $usuario->ehAdmin ? 'Sim' : 'Não';
                $row = [
                    $usuario->id,
                    mb_convert_encoding($usuario->nome ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($usuario->email ?? '', 'ISO-8859-1', 'UTF-8'),
                    mb_convert_encoding($usuario->fotoPerfil ?? '', 'ISO-8859-1', 'UTF-8'),
                    $ehAdminTexto,
                    mb_convert_encoding($usuario->status ?? '', 'ISO-8859-1', 'UTF-8'),
                    $usuario->created_at ? $usuario->created_at->format('Y-m-d H:i:s') : '',
                    $usuario->updated_at ? $usuario->updated_at->format('Y-m-d H:i:s') : '',
                ];

                fputcsv($file, $row, ';');
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    public function showProfile(Usuario $usuario)
    {
        $usuario->load(['filmesAssistidos', 'listas', 'avaliacoes']);

        return view('usuario')->with('usuario', $usuario);
    }

    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios')->with('usuarios', $usuarios);
    }

    public function all()
    {
        return Usuario::all();
    }

    public function create()
    {
        //
    }

    public function storeAPI(Request $request)
    {
        $usuario = new Usuario();
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;

        $senhaAleatoria = Str::random(16);

        $usuario->senha = Hash::make($senhaAleatoria);

        if ($request->hasFile('fotoPerfil')) {
            $caminho = $request->file('fotoPerfil')->store('usuarios/perfis', 'public');
            $usuario->fotoPerfil = $caminho; 
        }

        $usuario->ehAdmin = $request->ehAdmin;

        $usuario->save();

        return response()->json([
            'success' => true,
            'message' => 'Usuário salvo com sucesso!',
            'data' => $usuario
        ], 201);
    }

    
    /**
     * Display the specified resource.
     */
    public function showAPI(Usuario $usuario)
    {
        return response()->json($usuario->load(['listas', 'avaliacoes']), 200);
    }


    public function edit(Usuario $usuario)
    {
        //
    }

    public function updateAPI(Request $request, Usuario $usuario)
    {
        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->ehAdmin = $request->ehAdmin ?? 0;
        $usuario->status = $request->status ?? 'Ativo';

        if ($request->hasFile('fotoPerfil')) {
            if ($usuario->fotoPerfil) {
                Storage::disk('public')->delete($usuario->fotoPerfil);
            }

            $caminho = $request->file('fotoPerfil')->store('usuarios/perfis', 'public');
            $usuario->fotoPerfil = $caminho;
        }

        $usuario->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Usuário editado com sucesso!',
            'data' => $usuario
        ], 200);
    }

    public function destroyAPI(Usuario $usuario)
    {
        $usuario->update([
            'status' => 'Deletado'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuário excluído com sucesso!',
            'data' => $usuario
        ], 200);
    }

    public function buscar(Request $request) {
        $termo = $request->input('q');

        if(!$termo) {
            return response()->json(['erro' => 'Termo de busca não informado.'], 400);
        }

        $usuarios = Usuario::where('nome', 'like', "%{$termo}%")
        ->orWhere('email', 'like', "%{$termo}%")
        ->get();

        return response()->json($usuarios);
    }

    public function reactivateAPI(Usuario $usuario)
    {
        $usuario->update(
            ['status' => 'ativo']
        );

        return response()->json([
            'success' => true,
            'message' => 'Usuário reativado com sucesso!',
            'data' => $usuario
        ], 200);
    }
}
?>