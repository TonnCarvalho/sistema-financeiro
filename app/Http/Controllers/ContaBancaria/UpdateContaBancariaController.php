<?php

namespace App\Http\Controllers\ContaBancaria;

use Exception;
use Illuminate\Http\Request;
use App\Models\ContaBancaria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UpdateContaBancariaController extends Controller
{
        public function update(int $id ,Request $request)
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
}
