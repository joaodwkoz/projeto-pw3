<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filme;
use App\Models\Avaliacao;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['id', 'nome', 'email', 'senha', 'ehAdmin', 'status', 'created_at','updated_at'];

    public function statusClass(){
        if($this->status == 'Ativo'){
            return 'active';
        } else if($this->status == 'Bloqueado'){
            return 'blocked';
        }

        return 'deleted';
    }

    public function filmesAssistidos()
    {
        return $this->belongsToMany(Filme::class, 'filme_usuario');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class);
    }

    public function listas()
    {
        return $this->hasMany(Lista::class);
    }
}
