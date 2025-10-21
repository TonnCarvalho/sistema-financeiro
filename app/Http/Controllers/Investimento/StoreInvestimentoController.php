<?php

namespace App\Http\Controllers\Investimento;

use Exception;
use App\Models\Investimento;
use Illuminate\Http\Request;
use App\Models\InvestimentoExtrato;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StoreInvestimentoController extends Controller
{
    protected int $userId;

    public function __construct()
    {
        $this->userId = session('user.id');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'conta_bancaria' => 'required|integer',
            'nome' => 'required|string|min:3|max:255',
            'valor_aplicado' => 'nullable|numeric',
            'tipo_investimento' => 'required|string',
            'data' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->getMessages()
            ], 422);
        };

        try {

            $investimento = Investimento::create([
                'user_id' => $this->userId,
                'conta_bancaria_id' => $request->conta_bancaria,
                'nome' => $request->nome,
                'valor_aplicado' => $request->valor_aplicado,
                'valor_bruto' => $request->valor_aplicado,
                'valor_liquido' => $request->valor_aplicado,
                'tipo_investimento' => $request->tipo_investimento,
                'created_at' => $request->data
            ]);

            InvestimentoExtrato::create([
                'user_id' => $this->userId,
                'investimento_id' => $investimento->id,
                'valor_aplicado' => $request->valor_aplicado,
                'created_at' => $request->data
            ]);

            $request->session()->flash('success', 'Investimento criado com sucesso!');

            return response()->json([
                'success' => true
            ], 201);
            
        } catch (Exception $e) {
            return response()->json([
                'errors' => 'Error interno',
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
