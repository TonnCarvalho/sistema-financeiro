<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;

class ExtratoCompletoCdb extends Controller
{
    public function extratoCompletoCdb(Investimento $investimento)
    {
        $investimentoDetalhe = Investimento::with('contaBancaria.banco')
            ->find($investimento->id);

        $investimentoExtrato = InvestimentoExtrato::where('investimento_id', $investimento->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view(
            'investimento.investimento-extrato',
            compact(
                'investimentoExtrato',
                'investimentoDetalhe',
            )
        );
    }
}
