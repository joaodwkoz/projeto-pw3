<?php

namespace App\Observers;

use App\Models\AtividadeRecente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AtividadeObserver
{
    public function created(Model $model)
    {
        $this->log($model, 'created');
    }

    public function updated(Model $model)
    {
        $this->log($model, 'updated');
    }

    public function deleted(Model $model)
    {
        $this->log($model, 'deleted');
    }

    private function log(Model $model, string $acao)
    {
        // Apenas salva se houver um usuário logado
        $usuarioId = Auth::check() ? Auth::id() : null;

        AtividadeRecente::create([
            'usuario_id'     => $usuarioId,
            'acao'           => $acao,
            'descricao'      => class_basename($model) . " {$acao}",
            'entidade_tipo'  => get_class($model),
            'entidade_id'    => $model->id,
            'propriedades'   => $model->getChanges(), // mostra o que mudou
        ]);
    }
}
