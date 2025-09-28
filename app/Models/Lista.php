<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    use HasFactory;

    protected $table = 'listas';

    protected $fillable = ['usuario_id', 'nome', 'descricao'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function filmes()
    {
        return $this->belongsToMany(Filme::class, 'lista_filme');
    }
}
