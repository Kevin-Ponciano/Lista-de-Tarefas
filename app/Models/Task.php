<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // Como foi usado a diretiva @CSRF no forms, é preciso informar o campo a qual o banco espera receber
    protected $fillable=['name','cost','deadline','order'];
}
