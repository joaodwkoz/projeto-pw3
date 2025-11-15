<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $table = 'filmes';

    protected $fillable = ['nome', 'diretor', 'ano_lancamento', 'classificacao_id', 'sinopse', 'trailer', 'capa', 'status'];

    public function generos()
    {
        return $this->belongsToMany(Genero::class, 'filme_genero');
    }

    public function classificacao()
    {
        return $this->belongsTo(Classificacao::class, 'classificacao_id');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function listas()
    {
        return $this->belongsToMany(Lista::class, 'lista_filme');
    }

    public function usuariosQueAssistiram()
    {
        return $this->belongsToMany(Usuario::class, 'filme_usuario');
    }

    public function getNotaMediaAttribute()
    {
        return $this->avaliacoes()->avg('nota');
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