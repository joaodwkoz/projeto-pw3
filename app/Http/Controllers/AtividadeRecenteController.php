<?php

namespace App\Http\Controllers;

use App\Models\AtividadeRecente;
use Illuminate\Http\Request;

class AtividadeRecenteController extends Controller
{
    public static function registrar($usuarioId, $nome, $descricao = null, $entidade = null, $propriedades = [])
    {
        AtividadeRecente::create([
            'usuario_id' => $usuarioId,
            'nome' => $nome,
            'descricao' => $descricao,
            'entidade_id' => $entidade?->id,
            'entidade_tipo' => $entidade ? get_class($entidade) : null,
            'propriedades' => $propriedades,
        ]);
    }
}
