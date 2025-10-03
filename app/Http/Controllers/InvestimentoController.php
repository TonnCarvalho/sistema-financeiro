<?php

namespace App\Http\Controllers;

use App\Models\ContaBancaria;
use App\Models\Investimento;
use App\Models\InvestimentoExtrato;
use App\Models\InvestimentoExtratoDiario;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InvestimentoController extends Controller
{

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
    public function indexRendimento(Investimento $investimento, Request $request)
    {
        $investimento = Investimento::with('contaBancaria.banco')
            ->find($investimento->id);

        return view(
            'investimento.investimento-rendimento',
            compact([
                'investimento',
            ])
        );
    }
    public function storeRendimento(Investimento $investimento, Request $request)
    {
        $input = $request->validate(
            [
                'novo_valor_bruto' => 'required|numeric',
                'novo_valor_liquido' => 'required|numeric'
            ],
            ['required' => 'Campo obrigatório']
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
    public function extratoCompleto(Investimento $investimento)
    {
        $investimentoDetalhe = Investimento::with('contaBancaria.banco')
            ->find($investimento->id);

        $investimentoExtrato = InvestimentoExtrato::where('investimento_id', $investimento->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view(
            'investimento.investimento-extrato',
            compact(
                'investimentoExtrato',
                'investimentoDetalhe',
            )
        );
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
