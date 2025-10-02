<?php

namespace App\Http\Controllers\ContaBancaria;

use App\Models\Banco;
use App\Models\ContaBancaria;
use App\Http\Controllers\Controller;

class IndexContaBancariaController extends Controller
{
    public function index()
    {
        $contasBancarias = ContaBancaria::with('banco')->get();
        $bancos = Banco::orderBy('nome')->get();
        return view(
            'conta_bancaria.conta-bancaria',
            compact('contasBancarias', 'bancos')
        );
    }
}
