<?php

namespace App\Models;

use App\Models\ContaBancaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Investimento extends Model
{
    protected $table = 'investimentos';
    protected $fillable = [
        'user_id',
        'conta_bancaria_id',
        'nome',
        'valor',
        'tipo_investimento'
    ];

    public function contaBancaria(): belongsTo
    {
        return $this->belongsTo(ContaBancaria::class, 'conta_bancaria_id');
    }

}
