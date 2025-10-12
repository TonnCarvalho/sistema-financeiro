<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvestimentoExtrato extends Model
{
    protected $table = 'investimento_extrato';

    protected $fillable = [
        'user_id',
        'investimento_id',
        'valor_aplicado',
        'valor_bruto',
        'valor_liquido',
        'ganho_perda',
        'ir_iof',
        'movimento',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function investimento(): BelongsTo
    {
        return $this->belongsTo(Investimento::class);
    }
    public function investimentoExtratosDiarios(): HasMany
    {
        return $this->hasMany(InvestimentoExtratoDiario::class, 'investimento_extrato_id');
    }
}
