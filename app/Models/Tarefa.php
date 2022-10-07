<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $fillable=['nome_da_tarefa','custo','data_limite','ordem_de_apresentacao'];
}
