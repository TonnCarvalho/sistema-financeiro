<?php

namespace App\Http\Controllers\InvestimentoCdb;

use Exception;
use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GuardaInvestimentoCdb extends Controller
{
    private int $userId;

    public function __construction()
    {
        $this->userId = Auth::id();
    }
    public function guarda(Investimento $investimento, Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'guarda_valor' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->getMessages(),
            ], 422);
        }

        $valorBruto = $request->input('guarda_valor');

        try {
            if ($validator->passes()) {

                Investimento::where('id', $investimento->id)
                    ->increment('valor_bruto', $valorBruto);

                InvestimentoExtrato::create([
                    'user_id' => $this->userId,
                    'investimento_id' => $investimento->id,
                    'valor_bruto' => $valorBruto,
                    'valor_liquid' => 0,
                    'guardo_perda' => 0,
                    'ir_iof' => 0,
                    'movimento' => 'guardo'
                ]);;

                $request->session()->flash('success', "R$: $valorBruto reais, guardado com sucesso!");

                return response()->json([
                    'success' => true
                ], 201);
            }
        } catch (Exception $e) {;
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->getMessages()
                ], 422);
            };
        }
    }
}
