<?php

namespace App\Http\Controllers\ContaBancaria;

use Exception;
use Illuminate\Http\Request;
use App\Models\ContaBancaria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreContaBancariaController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::id();

        $validator = Validator::make(request()->all(), [
            'nome' => 'required|string',
            'banco_id' => 'required|int',
            'saldo' => 'required',
            'mostra_saldo' => 'required|boolean'
        ]);

        try {
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
}
