<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    public $fillable = ['id','nome','email','senha', 'ehAdmin', 'status', 'created_at','updated_at'];

    public function statusClass(){
        if($this->status == 'Ativo'){
            return 'active';
        } else if($this->status == 'Bloqueado'){
            return 'blocked';
        }

        return 'deleted';
    }
}
