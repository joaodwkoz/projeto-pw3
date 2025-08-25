<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends model 
{

    use HasFactory;

    protected $table = 'contato';

    public $fillable = ['id','nome','email','assunto','messagem','create_at','updated_at'];

    public function assuntoClass(){
        if($this->assunto == "erro"){
            return 'issue';
        } 
        
        if($this->assunto == "denuncia"){
            return 'report';
        } 
        
        if($this->assunto == "sugestao"){
            return 'suggestion';
        }  
    }
}
?>