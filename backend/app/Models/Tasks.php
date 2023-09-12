<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks'; 

    protected $fillable = [      
        'id_usuario',
        'token_tarefa',
        'titulo',
        'descricao',
        'data_vencimento'
    ];
}