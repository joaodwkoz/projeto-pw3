<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model 
{

    use HasFactory;

    protected $table = 'contatos';

    public $fillable = ['id','nome','email','assunto','mensagem','created_at','updated_at'];

    public function assuntoClass(){
        if($this->assunto == "problema"){
            return 'issue';
        } 
        
        if($this->assunto == "denuncia"){
            return 'report';
        } 
        
        if($this->assunto == "sugestao"){
            return 'suggestion';
        }

        return 'question';
    }

    public function assuntoTexto(){
        if($this->assunto == "problema"){
            return 'Problema';
        } 
        
        if($this->assunto == "denuncia"){
            return 'Denúncia';
        } 
        
        if($this->assunto == "sugestao"){
            return 'Sugestão';
        }

        return 'Dúvida';
    }
}
?>