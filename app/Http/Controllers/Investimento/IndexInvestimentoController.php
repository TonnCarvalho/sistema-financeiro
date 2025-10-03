<?php

namespace App\Http\Controllers\Investimento;

use App\Models\Investimento;
use App\Models\ContaBancaria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexInvestimentoController extends Controller
{

    protected int $userId;
    
    public function __construct()
    {
        $this->userId = Auth::id();
    }

    public function index()
    {
        $contaBancaria = ContaBancaria::where('user_id', $this->userId)
            ->orderBy('nome')
            ->get();

        $investimento = Investimento::with('contaBancaria.banco')
            ->where('user_id', $this->userId)
            ->get();

        return view(
            'investimento.investimento',
            compact(
                'contaBancaria',
                'investimento',
            )
        );
    }
}
