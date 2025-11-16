<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes';

    protected $fillable = ['id', 'usuario_id', 'filme_id', 'nota', 'comentario', 'status'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function filme()
    {
        return $this->belongsTo(Filme::class, 'filme_id');
    }

    public function getTempoDesde()
    {
        $dataReferencia = $this->updated_at; 

        $minutos = $dataReferencia->diffInMinutes();
        $horas = $dataReferencia->diffInHours();
        $dias = $dataReferencia->diffInDays();
        $meses = $dataReferencia->diffInMonths();

        if ($minutos < 60) {
            return $minutos > 1 ? "Há $minutos min" : "Agora mesmo";
        } elseif ($horas < 24) {
            return $horas > 1 ? "Há $horas horas" : "Há $horas hora";
        } elseif ($dias < 30) {
            return $dias > 1 ? "Há $dias dias" : "Há $dias dia";
        } elseif ($meses < 12) {
            return $meses > 1 ? "Há $meses meses" : "Há $meses mês";
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