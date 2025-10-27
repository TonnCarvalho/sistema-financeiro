<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use App\Models\InvestimentoExtratoDiario;
use Illuminate\Support\Facades\Validator;
use App\Services\ServicesGetInvestimentoValoresAtual;

class ResgataInvestimentoCdbController extends Controller
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

        //Calculo dos valores
        $investimento_valor_atual = ServicesGetInvestimentoValoresAtual::getValoresAtual($investimento->id);

        $novo_valor_bruto = $investimento_valor_atual['valor_bruto'] - $request->resgata_valor;
        $novo_valor_liquido = $investimento_valor_atual['valor_liquido'] - $request->resgata_valor;

        Investimento::find($investimento->id)
            ->decrementEach([
                'valor_bruto' => $request->resgata_valor,
                'valor_liquido' => $request->resgata_valor,
            ]);

        $investimentoExtrato = InvestimentoExtrato::create([
            'user_id' => $this->userId,
            'investimento_id' => $investimento->id,
            'valor_aplicado' => '-' . $request->resgata_valor,
            'valor_bruto' => $novo_valor_bruto,
            'valor_liquido' => $novo_valor_liquido,
            'ganho_perda' => $investimento_valor_atual['ganho_perda'],
            'ir_iof' => $investimento_valor_atual['ir_iof'],
            'movimento' => 'saida'
        ]);

        InvestimentoExtratoDiario::create([
            'investimento_id' => $investimento->id,
            'investimento_extrato_id' => $investimentoExtrato->id,
            'valor_bruto_diario' => $request->resgata_valor,
            'valor_liquido_diario' => $request->resgata_valor,
            'movimento' => 'saida',
            'created_at' => $request['data']
        ]);

        $request->session()->flash('success', "R$: {$request->resgata_valor}  reais resgatado com sucesso!");

        return redirect()->route('investimento.show', $investimento->id);
    }
}
