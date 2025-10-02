<?php

namespace App\Http\Controllers\ContaBancaria;

use App\Models\Banco;
use Illuminate\Http\Request;
use App\Models\ContaBancaria;
use App\Http\Controllers\Controller;

class ShowContaBancariaController extends Controller
{
    public function show(string $id, ContaBancaria $contaBancaria, Banco $banco)
    {
        $contasBancarias = $contaBancaria::find($id);
        $bancos = $banco::orderBy('nome')->get();

        return view(
            'conta_bancaria.conta-bancaria-show',
            compact(
                'contasBancarias',
                'bancos',
            )
        );
    }
}
