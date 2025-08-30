<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use Illuminate\Http\Request;
use App\Models\ContaBancaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContaBancariaController extends Controller
{

    public function index()
    {
        $contas_bancarias = ContaBancaria::with('banco')->get();
        $bancos = Bancos::orderBy('nome')->get();
        return view(
            'conta_bancaria.conta-bancaria',
            compact('contas_bancarias', 'bancos')
        );
    }

    public function store(Request $request)
    {
        //FAZ A VALIDAÇÃO
        $validator = Validator::make(request()->all(), [
            'nome' => 'required|string',
            'banco_id' => 'required|int',
            'saldo' => 'required',
            'mostra_saldo' => 'required|boolean'
        ]);

        //VALIDA OS ERROS
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->getMessages() //RETORN O ERROR PELO JSON
            ], 400);
        };

        ContaBancaria::create([
            'user_id' => Auth::id(),
            'nome' => $request->nome,
            'banco_id' => $request->banco_id,
            'saldo' => $request->saldo,
            'mostra_saldo' => $request->boolean('mostra_saldo')
        ]);
        $request->session()->flash('success');

        return response()->json([
            'success' => 'Conta criado com sucesso'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ContaBancaria $contas_bancarias)
    {
        $dados_bancario = $contas_bancarias::find($id);

        return view(
            'conta_bancaria.conta-bancaria-show',
            [
                'dados_bancario' => $dados_bancario
            ]
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
        dd('Excluido com sucesso');
    }
}
