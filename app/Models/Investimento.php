<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investimento extends Model
{
    protected $fillable = [
        'user_id',
        'conta_bancaria_id',
        'nome',
        'valor',
        'tipo_investimento'
    ];
}
