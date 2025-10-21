<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexAddRendimentoCdb extends Controller
{
    public function indexAddRendimentoCdb(Investimento $investimento, Request $request)
    {
        $investimento = Investimento::with('contaBancaria.banco')
            ->find($investimento->id);

        return view(
            'investimento_cdb.rendimento',
            compact([
                'investimento',
            ])
        );
    }
}
