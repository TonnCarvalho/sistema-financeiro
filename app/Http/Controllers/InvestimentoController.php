<?php

namespace App\Http\Controllers;

use App\Models\ContaBancaria;
use App\Models\Investimento;
use App\Models\InvestimentoExtrato;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvestimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $contaBancaria = ContaBancaria::where('user_id', $user)
            ->orderBy('nome')
            ->get();

        $investimento = Investimento::with('contaBancaria.banco')
            ->where('user_id', $user)
            ->get();

        return view(
            'investimento.investimento',
            compact(
                'contaBancaria',
                'investimento',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::id();
        $validator = Validator::make(request()->all(), [
            'conta_bancaria' => 'required|integer',
            'nome' => 'required|string|min:3|max:255',
            'valor' => 'nullable|numeric',
            'tipo_investimento' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->getMessages()
            ], 422);
        };

        try {
            Investimento::create([
                'user_id' => $user,
                'conta_bancaria_id' => $request->conta_bancaria,
                'nome' => $request->nome,
                'valor_bruto' => $request->valor_bruto,
                'tipo_investimento' => $request->tipo_investimento
            ]);

            $request->session()->flash('success', 'Investimento criado com sucesso!');

            return response()->json([
                'success'
            ], 201);
        } catch (Exception $e) {
            if ($validator->fails()) {
                return response()->json([
                    'errors' => 'Error interno',
                    'message' => $e->getMessage()
                ], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Investimento $investimento)
    {
        $investimento = Investimento::with('contaBancaria.banco')
            ->find($investimento->id);

        $investimentoExtrato = InvestimentoExtrato::where('investimento_id', $investimento->id)
            ->orderBy('created_at', 'DESC')
            ->limit(3)
            ->get();

        return view(
            'investimento.investimento-show',
            compact(
                'investimento',
                'investimentoExtrato',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
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
        $user = Auth::id();
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
                    'user_id' => $user,
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
    public function getValores()
    {
        $valorBruto = '';
        $valorLiquido = '';
        $ganhoPerda = '';
        $irIof = '';
    }
}
