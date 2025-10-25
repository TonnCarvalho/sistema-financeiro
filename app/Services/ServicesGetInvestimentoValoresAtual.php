<?php

namespace App\Services;

use App\Models\Investimento;

class ServicesGetInvestimentoValoresAtual
{
    public static function getValoresAtual($investimentoId)
    {
        $investimento_valores = Investimento::find($investimentoId)
            ->get(['valor_bruto', 'valor_liquido', 'ganho_perda', 'ir_iof'])
            ->toArray();

        foreach ($investimento_valores as $investimento_valor) {
            $valores = [
                'valor_bruto' => (float) $investimento_valor['valor_bruto'],
                'valor_liquido' => (float) $investimento_valor['valor_liquido'],
                'ganho_perda' => (float) $investimento_valor['ganho_perda'],
                'ir_iof' => (float) $investimento_valor['ir_iof']
            ];
        };
        return $valores;
    }
}
