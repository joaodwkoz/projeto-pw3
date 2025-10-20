<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtividadeRecente extends Model
{
    use HasFactory;

    protected $table = 'atividades_recentes';

    protected $guarded = [];
    
    protected $casts = [
        'propriedades' => 'array',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id'); 
    }

    public function entidade()
    {
        return $this->morphTo(null, 'entidade_tipo', 'entidade_id');
    }
}