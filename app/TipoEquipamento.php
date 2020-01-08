<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEquipamento extends Model
{
    protected $table = 'tipo_equipamentos';
    protected $fillable = [
        'descricao'
    ];
}
