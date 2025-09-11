<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
}
