<?php

namespace App\Services;

use App\Models\AtividadeRecente;

class AtividadeService
{
    public static function registrar($nome, $descricao, $usuarioId, $entidade = null, $propriedades = [])
    {
        return AtividadeRecente::create([
            'nome' => $nome,
            'descricao' => $descricao,
            'usuario_id' => $usuarioId,
            'entidade_tipo' => $entidade ? get_class($entidade) : null,
            'entidade_id' => $entidade->id ?? null,
            'propriedades' => $propriedades,
        ]);
    }
}
