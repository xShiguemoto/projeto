<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTasks extends Model
{
    protected $table = 'subtasks'; 

    protected $fillable = [      
        'id_tarefa',
        'titulo',
        'descricao',
    ];
}