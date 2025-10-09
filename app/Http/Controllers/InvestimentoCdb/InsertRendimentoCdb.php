<?php

namespace App\Http\Controllers\InvestimentoCdb;

use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\InvestimentoExtratoDiario;

class InsertRendimentoCdb extends Controller
{
    protected int $userId;

    public function __construct()
    {
        $this->userId = Auth::id();
    }

    public function insertRendimentoCdb(Investimento $investimento, Request $request)
    {

        $input = $request->validate(
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
        if ($input) {

            $investimento_valor_atual = $this->getValores($investimento->id);

            //calculo
            $novo_valor_bruto = (float) $input['novo_valor_bruto'];
            $novo_valor_liquido = (float) $input['novo_valor_liquido'];
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
            ]);

            InvestimentoExtratoDiario::create([
                'investimento_id' => $investimento->id,
                'investimento_extrato_id' => $investimentoExtrato->id,
                'valor_bruto_diario' => $valor_bruto_diario,
                'valor_liquido_diario' => $valor_liquido_diario,
                'ganho_perda_diario' => $ganho_perda_diario,
                'ir_iof_diario' => $ir_iof_diario,
            ]);

            $message = 'Rendimento registrado com sucesso!';
        } catch (\Exception $e) {
            $message = $e->getMessage();
        } finally {
            return redirect()->route('investimento.show', $investimento->id)->with(['success' => $message]);
        }
    }

    public function getValores($investimentoId)
    {
        $investimento_valores = Investimento::where('id', $investimentoId)
            ->get(['valor_bruto', 'valor_liquido', 'ganho_perda', 'ir_iof'])
            ->toArray();

        foreach ($investimento_valores as $investimento_valor) {
            $valores = [
                'valor_bruto' => (float) $investimento_valor['valor_bruto'],
                'valor_liquido' => (float) $investimento_valor['valor_liquido'],
                'ganho_perda' => (float) $investimento_valor['ganho_perda'],
                'ir_iof' => (float) $investimento_valor['ir_iof']
            ];
        };
        return $valores;
    }
}
