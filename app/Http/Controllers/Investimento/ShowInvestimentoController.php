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

        $investimentoExtrato = InvestimentoExtrato::with('investimentoExtratosDiarios')
            ->where('investimento_id', $id)
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();


        return view(
            'investimento.investimento-show',
            compact(
                'investimento',
                'investimentoExtrato',
            )
        );
    }
}
