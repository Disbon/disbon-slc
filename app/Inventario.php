<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{

    protected $fillable = [
        'codfilial',
        'tipo_equipamento',
        'descricao',
        'setor',
        'usuario',
        'documento',
        'valor',
        'user_add',
        'user_up',
        'created_at',
    ];

}
