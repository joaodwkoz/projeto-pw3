<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model 
{

    use HasFactory;

    protected $table = 'contatos';

    protected $fillable = ['id', 'nome', 'email', 'assunto', 'mensagem', 'status'];

    public function showStatusHTML()
    {
        $status = match($this->status) {
            'nao_resolvido' => 'Não resolvido',
            'resolvido' => 'Resolvido',
            default => 'Pendente'
        };

        return $status;
    }

    public function showAssuntoHTML()
    {
        $assunto = match($this->assunto) {
            'duvida' => 'Dúvida',
            'problema' => 'Problema',
            'denuncia' => 'Denúncia',
            default => 'Sugestão'
        };

        return $assunto;
    }
}