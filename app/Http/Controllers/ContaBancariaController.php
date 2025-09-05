<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\ContaBancaria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContaBancariaController extends Controller
{

    public function index()
    {
        $contasBancarias = ContaBancaria::with('banco')->get();
        $bancos = Banco::orderBy('nome')->get();
        return view(
            'conta_bancaria.conta-bancaria',
            compact('contasBancarias', 'bancos')
        );
    }

    public function store(Request $request)
    {
        $user = Auth::id();

        //valida dados
        $validator = Validator::make(request()->all(), [
            'nome' => 'required|string',
            'banco_id' => 'required|int',
            'saldo' => 'required',
            'mostra_saldo' => 'required|boolean'
        ]);

        try {
            //persiste no banco de dados
            ContaBancaria::create([
                'user_id' => $user,
                'nome' => $request->nome,
                'banco_id' => $request->banco_id,
                'saldo' => $request->saldo,
                'mostra_saldo' => $request->boolean('mostra_saldo')
            ]);

            $request->session()->flash('success', 'Conta criada com sucesso!');

            return response()->json([
                'success'
            ], 201);
        } catch (Exception $e) {
            //valida o error
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->getMessages() //RETORN O ERROR PELO JSON
                ], 422);
            };
        }
    }

    public function show(string $id, ContaBancaria $contaBancaria, Banco $banco)
    {
        $contasBancarias = $contaBancaria::find($id);
        $bancos = $banco::orderBy('nome')->get();

        return view(
            'conta_bancaria.conta-bancaria-show',
            compact(
                'contasBancarias',
                'bancos',
            )
        );
    }

    public function update(Request $request, string $id)
    {
        //converter o valor para booleano
        $request->merge([
            'mostra_saldo' => filter_var($request->mostra_saldo, FILTER_VALIDATE_BOOLEAN)
        ]);
        //valida dados
        $validator = Validator::make(request()->all(), [
            'nome' => 'required|string|min:3|max:100',
            'banco_id' => 'required|integer',
            'saldo' => 'required|numeric|min:0',
            'mostra_saldo' => 'required|boolean'
        ]);

        try {
            //atualiza dados
            ContaBancaria::where('id', $id)->update([
                "banco_id" => $request->banco_id,
                "nome" => $request->nome,
                "saldo" => $request->saldo,
                "mostra_saldo" => $request->boolean('mostra_saldo')
            ]);

            $request->session()->flash('success', 'Conta atualizada com sucesso!');

            return response()->json([
                'success'
            ], 201);
        } catch (Exception $e) {
            //valida o error
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->getMessages()
                ], 400);
            }
        }
    }

    public function destroy(string $id)
    {
        ContaBancaria::destroy($id);

        return redirect()->route('conta-bancaria.index')
            ->with('success', 'Conta excluida com sucesso!');
    }
}
