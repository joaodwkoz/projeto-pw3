<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    
    protected $table = 'generos';

    protected $fillable = ['nome', 'cor', 'status'];

    public function filmes()
    {
        return $this->belongsToMany(Filme::class);
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
