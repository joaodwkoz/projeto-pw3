<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;

    protected $table = 'filmes';

    protected $fillable = ['nome', 'diretor', 'ano_lancamento', 'classificacao_id', 'sinopse', 'trailer', 'capa', 'banner'];

    public function generos()
    {
        return $this->belongsToMany(Genero::class);
    }

    public function classificacao()
    {
        return $this->belongsTo(Classificacao::class, 'classificacao_id');
    }
}