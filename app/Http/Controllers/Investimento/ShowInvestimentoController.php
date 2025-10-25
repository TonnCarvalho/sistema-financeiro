<?php

namespace App\Http\Controllers\Investimento;

use App\Models\Investimento;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowInvestimentoController extends Controller
{
    protected int $userId;

    public function __construct()
    {
        $this->userId = Auth::id();
    }

    public function show(int $id)
    {
        $investimento = Investimento::with('contaBancaria.banco')
            ->find($id);

        $investimentoExtrato = InvestimentoExtrato::where('investimento_id', $id)
            ->orderBy('id', 'DESC')
            ->limit(3)
            ->get();
        // $investimentoExtrato->load('investimentoExtratosDiarios');


        return view(
            'investimento_cdb.investimento-show',
            compact(
                'investimento',
                'investimentoExtrato',
            )
        );
    }
}
