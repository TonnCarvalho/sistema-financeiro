<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use App\Models\InvestimentoExtratoDiario;
use Illuminate\Support\Facades\Validator;
use App\Services\ServicesGetInvestimentoValoresAtual;

class AddRendimentoCdb extends Controller
{
    public function ViewAddRendimentoCdb(Investimento $investimento, Request $request)
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

    public function insertAddRendimentoCdb(Investimento $investimento, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'novo_valor_bruto' => 'required|numeric',
                'novo_valor_liquido' => 'required|numeric',
                'data' => 'required|date|before_or_equal:today'
            ],
            [
                'required' => 'Campo obrigatório',
                'before_or_equal' => 'Data invalida'
            ]
        );
        //verifica erro de validação
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $investimento_valor_atual = ServicesGetInvestimentoValoresAtual::getValoresAtual($investimento->id);

            //calculo
            $novo_valor_bruto = (float) $request->novo_valor_bruto;
            $novo_valor_liquido = (float) $request->novo_valor_liquido;
            $novo_ganho_perda = $novo_valor_liquido - $investimento_valor_atual['valor_liquido'];
            $novo_ir_iof = $novo_valor_bruto - $novo_valor_liquido;

            //calculo diario
            $valor_bruto_diario = $novo_valor_bruto - $investimento_valor_atual['valor_bruto'];
            $valor_liquido_diario = $novo_valor_liquido - $investimento_valor_atual['valor_liquido'];
            $ganho_perda_diario = $valor_bruto_diario - $valor_liquido_diario;
            $ir_iof_diario = $valor_bruto_diario - $valor_liquido_diario;


            Investimento::where('id', $investimento->id)
                ->update([
                    'valor_bruto' => $novo_valor_bruto,
                    'valor_liquido' => $novo_valor_liquido,
                    'ganho_perda' => round($novo_ganho_perda, 2),
                    'ir_iof' => $novo_ir_iof,
                    'updated_at' => now()
                ]);

            $investimentoExtrato = InvestimentoExtrato::create([
                'user_id' => session('user.id'),
                'investimento_id' => $investimento->id,
                'valor_bruto' => $novo_valor_bruto,
                'valor_liquido' => $novo_valor_liquido,
                'ganho_perda' => round($novo_ganho_perda, 2),
                'ir_iof' => $novo_ir_iof,
                'movimento' => 'rendimento',
                'created_at' => $request['data'],
            ]);

            InvestimentoExtratoDiario::create([
                'investimento_id' => $investimento->id,
                'investimento_extrato_id' => $investimentoExtrato->id,
                'valor_bruto_diario' => $valor_bruto_diario,
                'valor_liquido_diario' => $valor_liquido_diario,
                'ganho_perda_diario' => $ganho_perda_diario,
                'ir_iof_diario' => $ir_iof_diario,
                'movimento' => 'rendimento',
                'created_at' => $request['data']
            ]);

            $message = 'Rendimento registrado com sucesso!';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        } finally {
            return redirect()->route('investimento.show', $investimento->id)->with(['success' => $message]);
        }
    }
}
