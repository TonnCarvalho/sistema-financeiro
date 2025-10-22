<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\InvestimentoExtrato;
use Illuminate\Support\Facades\Validator;

class ShowResgataInvestimentoCdbController extends Controller
{
    protected int $userId;

    public function __construct()
    {
        $this->userId = session('user.id');
    }

    public function viewResgata(Request $request, Investimento $investimento)
    {
        $investimento = Investimento::find($investimento->id);

        return view('investimento_cdb.resgatar', compact(
            [
                'investimento'
            ]
        ));
    }

    public function storeResgata(Request $request, Investimento $investimento)
    {
        //valida
        $validator = Validator::make($request->all(), [
            'resgata_valor' => 'required',
            'data' => 'required|date|before_or_equal:today'
        ], [
            'required' => 'Campo obrigatório',
            'data.before_or_equal' => 'Data invalida'
        ]);

        //verifica erro de validação
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        Investimento::find($investimento->id)
            ->decrementEach([
                'valor_bruto' => $request->resgata_valor,
                'valor_liquido' => $request->resgata_valor,
            ]);

        InvestimentoExtrato::create([
            'user_id' => $this->userId,
            'investimento_id' => $investimento->id,
            'valor_aplicado' => '-' . $request->resgata_valor,
            'movimento' => 'saida'
        ]);
        $request->session()->flash('success', "R$: {$request->resgata_valor}  reais resgatado com sucesso!");
        return redirect()->back();
    }
}
