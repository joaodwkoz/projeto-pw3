<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use App\Models\Filme;
use App\Models\Avaliacao;
use App\Models\Lista;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    // Campos que podem ser preenchidos via create()
    protected $fillable = ['nome', 'email', 'senha', 'ehAdmin', 'status'];

    // Campos ocultos
    protected $hidden = ['senha'];

    // Define valor padrão caso não seja enviado
    protected $attributes = [
        'ehAdmin' => false,
        'status' => 'Ativo',
    ];

    /**
     * Retorna o campo de senha usado pelo Auth (Laravel espera "password").
     */
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**


     * Classe CSS baseada no status.
     */
    public function statusClass()
    {
        if ($this->status === 'Ativo') {
            return 'active';
        } elseif ($this->status === 'Bloqueado') {
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
