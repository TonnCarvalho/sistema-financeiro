<?php

namespace App\Http\Controllers;

use App\Models\ContaBancaria;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        Auth::loginUsingId(1);
        $user = Auth::id();
        $bancoUsuario = $this->bancoUsuario($user);
        $totalBanco = $this->totalBanco($user);
        $totalSaldo = $this->totalSaldo($user);

        return view(
            'dashboard.dashboard',
            compact(
                'user',
                'bancoUsuario',
                'totalBanco',
                'totalSaldo'
            )
        );
    }
    private function bancoUsuario($user)
    {
        $contaBancaria = ContaBancaria::where('user_id', $user)
            ->with('banco')
            ->limit(3)
            ->get();
        return $contaBancaria;
    }
    private function totalBanco($user)
    {
        $totalBanco = ContaBancaria::where('user_id', $user)
            ->get();
        return $totalBanco;
    }
    private function totalSaldo($user)
    {
        $totalSaldo = ContaBancaria::where('user_id', $user)
            ->sum('saldo');
        return $totalSaldo;
    }
}
