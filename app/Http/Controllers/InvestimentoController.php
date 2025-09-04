<?php

namespace App\Http\Controllers;

use App\Models\ContaBancaria;
use App\Models\Investimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class InvestimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::id();
        $banco = ContaBancaria::where('user_id', $user)->orderBy('nome')->get();

        return view(
            'investimento.investimento',
            compact(
                'banco'
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
            }

        try {
            Investimento::create([
                'user_id' => $user,
                'conta_bancaria_id' => $request->conta_bancaria,
                'nome' => $request->nome,
                'valor' => $request->valor,
                'tipo_investimento' => $request->tipo_investimento
            ]);
            $request->session()->flash('success', 'Investimento criado com sucesso!');

            return response()->json([
                'success' => true,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erro ao criar investimento: ' . $e->getMessage());
            if ($validator->fails()) {
                return response()->json([
                    'errors' => 'Error interno',
                     'message' => $e->getMessage() // Para debug - remova em produção
                ], 422);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
