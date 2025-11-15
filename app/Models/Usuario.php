<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\Filme;
use App\Models\Avaliacao;
use App\Models\Lista;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    // Campos que podem ser preenchidos via create()
    protected $fillable = ['nome', 'email', 'senha', 'fotoPerfil', 'ehAdmin', 'status'];

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

    public function filmesAssistidos()
    {
        return $this->belongsToMany(Filme::class, 'filme_usuario');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class)->orderByDesc('created_at');;
    }

    public function listas()
    {
        return $this->hasMany(Lista::class);
    }

    /**
     * Classe CSS baseada no status.
     */
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
