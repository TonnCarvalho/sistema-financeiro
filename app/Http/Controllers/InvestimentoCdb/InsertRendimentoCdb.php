<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\InvestimentoExtratoDiario;
use App\Services\ServicesGetInvestimentoValoresAtual;
use Illuminate\Support\Facades\Validator;

class InsertRendimentoCdb extends Controller
{
    protected int $userId;

    public function __construct()
    {
        $this->userId = Auth::id();
    }

    public function insertRendimentoCdb(Investimento $investimento, Request $request)
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

        if ($validator->passes()) {
            $investimento_valor_atual = ServicesGetInvestimentoValoresAtual::getValoresAtual($investimento->id);

            //calculo
            $novo_valor_bruto = (float) $request->novo_valor_bruto;
            $novo_valor_liquido = (float) $request->novo_valor_liquido;
            $novo_ir_iof = $novo_valor_bruto - $novo_valor_liquido;
            $novo_ganho_perda = $novo_valor_liquido - $investimento_valor_atual['valor_liquido'];

            //calculo diario
            $valor_bruto_diario = $novo_valor_bruto - $investimento_valor_atual['valor_bruto'];
            $valor_liquido_diario = $novo_valor_liquido - $investimento_valor_atual['valor_liquido'];
            $ir_iof_diario = $valor_bruto_diario - $valor_liquido_diario;
            $ganho_perda_diario = $valor_bruto_diario - $valor_liquido_diario;
        }
        try {
            Investimento::where('id', $investimento->id)
                ->update([
                    'valor_bruto' => $novo_valor_bruto,
                    'valor_liquido' => $novo_valor_liquido,
                    'ir_iof' => $novo_ir_iof,
                    'ganho_perda' => round($novo_ganho_perda, 2),
                    'updated_at' => now()
                ]);

            $investimentoExtrato = InvestimentoExtrato::create([
                'user_id' => $this->userId,
                'investimento_id' => $investimento->id,
                'valor_bruto' => $novo_valor_bruto,
                'valor_liquido' => $novo_valor_liquido,
                'ir_iof' => $novo_ir_iof,
                'ganho_perda' => round($novo_ganho_perda, 2),
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
