<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestimentoExtratoDiario extends Model
{
    protected $table = 'investimento_extrato_diario';

    protected $fillable = [
        'investimento_id',
        'investimento_extrato_id',
        'valor_bruto_diario',
        'valor_liquido_diario',
        'ganho_perda_diario',
        'ir_iof_diario',
    ];

    public function investimento(): BelongsTo
    {
        return $this->belongsTo(Investimento::class);
    }
    public function investimentoExtrato(): BelongsTo
    {
        return $this->belongsTo(InvestimentoExtrato::class);
    }
}
