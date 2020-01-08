<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    protected $fillable = [
        'numero',
        'assunto',
        'ambiente',
        'descricao',
        'prioridade',
        'telefone',
        'status',
        'matricula',    
    ];
}
