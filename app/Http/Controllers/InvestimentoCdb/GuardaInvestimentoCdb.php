<?php

namespace App\Http\Controllers\InvestimentoCdb;

use Exception;
use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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

        try {
            if ($validator->passes()) {

                Investimento::where('id', $investimento->id)
                    ->increment('valor_bruto', $request->valor_aplicado);

                InvestimentoExtrato::create([
                    'user_id' => $this->userId,
                    'investimento_id' => $investimento->id,
                    'valor_aplicado' => $request->valor_aplicado,
                    'movimento' => 'entrada',
                    'created_at' => $request->data
                ]);

                $request->session()->flash('success', "R$: $request->valor_aplicado reais, aplicado com sucesso!");

                return response()->json([
                    'success' => true
                ], 201);
            }
        } catch (Exception $e) {;
            return response()->json([
                'errors' => $validator->errors()->getMessages()
            ], 500);
        }
    }
}
