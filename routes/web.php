<?php

use App\Http\Controllers\ContaBancariaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestimentoController;
use App\Models\Investimento;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('conta-bancaria', ContaBancariaController::class)
    ->names([
        'index' => 'conta-bancaria.index',
        'store' => 'conta-bancaria.store',
        'show' => 'conta-bancaria.show',
        'update' => 'conta-bancaria.update',
        'destroy' => 'conta-bancaria.destroy'
    ]);

Route::resource('investimento', InvestimentoController::class)
    ->names([
        'index' => 'investimento.index',
        'store' => 'investimento.store',
        'show' => 'investimento.show',
    ]);
Route::get('investimento/{investimento}/extrato', [InvestimentoController::class, 'extratoCompleto'])
    ->name('investimento.extrato');
    
Route::post('investimento/{investimento}/guarda', [InvestimentoController::class, 'guarda'])
    ->name('investimento.guarda');
