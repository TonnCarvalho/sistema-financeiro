<?php

namespace App\Http\Controllers\InvestimentoCdb;

use Exception;
use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\InvestimentoExtratoDiario;
use App\Services\ServicesGetInvestimentoValoresAtual;
use Illuminate\Support\Facades\Validator;

class GuardaInvestimentoCdb extends Controller
{
    protected int $userId;

    public function __construct()
    {
        $this->userId = session('user.id');
    }
    public function guarda(Investimento $investimento, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'valor_aplicado' => 'required|numeric',
            'data' => 'required|date|before_or_equal:today'
        ], [
            'before_or_equal' => 'Data invalida'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->getMessages(),
            ], 422);
        }

        $investimentoValorAtual = ServicesGetInvestimentoValoresAtual::getValoresAtual($investimento->id);
        $novo_valor_bruto = $investimentoValorAtual['valor_bruto'] + $request->valor_aplicado;
        $novo_valor_bruto = $investimentoValorAtual['valor_liquido'] + $request->valor_aplicado;

        try {
            Investimento::where('id', $investimento->id)
                ->incrementEach([
                    'valor_bruto' => $request->valor_aplicado,
                    'valor_liquido' => $request->valor_aplicado,
                ]);

            $investimentoExtrato = InvestimentoExtrato::create([
                'user_id' => $this->userId,
                'investimento_id' => $investimento->id,
                'valor_aplicado' => $request->valor_aplicado,
                'valor_bruto' => $novo_valor_bruto,
                'valor_liquido' => $novo_valor_bruto,
                'ganho_perda' => $investimentoValorAtual['ganho_perda'],
                'ir_iof' => $investimentoValorAtual['ir_iof'],
                'movimento' => 'entrada',
                'created_at' => $request->data
            ]);

            InvestimentoExtratoDiario::create([
                'investimento_id' => $investimento->id,
                'investimento_extrato_id' => $investimentoExtrato->id,
                'valor_bruto_diario' => $request->valor_aplicado,
                'valor_liquido_diario' => $request->valor_aplicado,
                'created_at' => $request->data
            ]);

            $request->session()->flash('success', "R$: $request->valor_aplicado reais, aplicado com sucesso!");

            return response()->json([
                'success' => true
            ], 201);
        } catch (Exception $e) {;
            return response()->json([
                'errors' => $validator->errors()->getMessages()
            ], 500);
        }
    }
}
