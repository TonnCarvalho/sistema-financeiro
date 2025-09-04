<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContaBancaria extends Model
{
    /** @use HasFactory<\Database\Factories\ContaBancariaFactory> */
    use HasFactory;

    protected $table = 'contas_bancarias';
    protected $fillable = [
        'user_id',
        'banco_id',
        'nome',
        'saldo',
        'mostra_saldo'
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function banco(): belongsTo
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }
}
