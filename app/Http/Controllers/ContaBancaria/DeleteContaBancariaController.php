<?php

namespace App\Http\Controllers\ContaBancaria;

use App\Models\ContaBancaria;
use App\Http\Controllers\Controller;

class DeleteContaBancariaController extends Controller
{
    public function delete(int $id)
    {
        ContaBancaria::destroy($id);

        return redirect()->route('conta-bancaria.index')
            ->with('success', 'Conta excluida com sucesso!');
    }
}
