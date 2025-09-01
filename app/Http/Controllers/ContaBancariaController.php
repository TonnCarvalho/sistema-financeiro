<?php

namespace App\Http\Controllers;

use App\Models\Bancos;
use Illuminate\Http\Request;
use App\Models\ContaBancaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ContaBancariaController extends Controller
{

    public function index(Request $request)
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
        $conta_bancaria = $contas_bancarias::find($id);
        $bancos = Bancos::orderBy('nome')->get();

        return view(
            'conta_bancaria.conta-bancaria-show',
            compact(
                'conta_bancaria',
                'bancos',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //converter o valor para booleano
        $request->merge([
            'mostra_saldo' => filter_var($request->mostra_saldo, FILTER_VALIDATE_BOOLEAN)
        ]);
        //valida dados
        $validator = Validator::make(request()->all(), [
            'nome' => 'required|string',
            'banco_id' => 'required|int',
            'saldo' => 'required',
            'mostra_saldo' => 'required|boolean'
        ]);

        //valida o error
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->getMessages()
            ], 400);
        }

        //atualiza dados
        ContaBancaria::where('id', $id)->update([
            "banco_id" => $request->banco_id,
            "nome" => $request->nome,
            "saldo" => $request->saldo,
            "mostra_saldo" => $request->boolean('mostra_saldo')
        ]);

        $request->session()->flash('success');

        return response()->json([
            'success' => 'Conta atualizada com sucesso'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ContaBancaria::destroy($id);

        return redirect()->route('conta-bancaria.index')
        ->with('delete', 'Conta excluida com sucesso!');
    }
}
