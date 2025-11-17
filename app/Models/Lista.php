<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'listas';

    protected $touches = ['filmes'];

    protected $fillable = ['usuario_id', 'nome', 'descricao', 'status'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function filmes()
    {
        return $this->belongsToMany(Filme::class, 'lista_filme')->withTimestamps();
    }

    public function getTempoDesdeUltimaAtualizacao()
    {
        $ultimoAdicionado = $this->filmes()->orderByDesc('pivot_created_at')->first(); 

        $dataReferencia = $this->updated_at; 

        if ($ultimoAdicionado) {
            $dataAdicaoMaisRecente = $ultimoAdicionado->pivot->created_at;
            $dataReferencia = max($dataReferencia, $dataAdicaoMaisRecente);
        }
        
        $minutos = $dataReferencia->diffInMinutes();
        $horas = $dataReferencia->diffInHours();
        $dias = $dataReferencia->diffInDays();
        $meses = $dataReferencia->diffInMonths();
        
        if ($minutos < 60) {
            return $minutos > 1 ? "há $minutos min" : "agora mesmo";
        } elseif ($horas < 24) {
            return $horas > 1 ? "há $horas horas" : "há $horas hora";
        } elseif ($dias < 30) {
            return $dias > 1 ? "há $dias dias" : "há $dias dia";
        } elseif ($meses < 12) {
            return $meses > 1 ? "há $meses meses" : "há $meses mês";
        } else {
            return $dataReferencia->format('d/m/Y');
        }
    }

    public function showStatusHTML()
    {
        $status = match($this->status) {
            'bloqueado' => 'Bloqueado',
            'deletado' => 'Deletado',
            default => 'Ativo'
        };

        return $status;
    }
}