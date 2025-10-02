<?php

use App\Http\Controllers\ContaBancaria\DeleteContaBancariaController;
use App\Http\Controllers\ContaBancaria\StoreContaBancariaController;
use App\Http\Controllers\ContaBancaria\IndexContaBancariaController;
use App\Http\Controllers\ContaBancaria\ShowContaBancariaController;
use App\Http\Controllers\ContaBancaria\UpdateContaBancariaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestimentoCdbController;
use App\Http\Controllers\InvestimentoController;
use App\Models\Investimento;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

//Conta Bancaria
Route::get('/conta-bancaria', [IndexContaBancariaController::class, 'index'])
    ->name('conta-bancaria.index');
Route::post('/conta-bancaria/store', [StoreContaBancariaController::class, 'store'])
    ->name('conta-bancaria.store');
Route::get('/conta-bancaria/show/{id}', [ShowContaBancariaController::class, 'show'])
    ->name('conta-bancaria.show');
Route::put('/conta-bancaria/update/{id}', [UpdateContaBancariaController::class, 'update'])
->name('conta-bancaria.update');
Route::delete('/conta-bancaria/delete/{id}', [DeleteContaBancariaController::class, 'delete'])
->name('conta-bancaria.delete');

//Investimento
Route::resource('investimento', InvestimentoController::class)
    ->names([
        'index' => 'investimento.index',
        'store' => 'investimento.store',
        'show' => 'investimento.show',
    ]);

Route::controller(InvestimentoController::class)->group(function () {
    Route::get('investimento/{investimento}/extrato',  'extratoCompleto')
        ->name('investimento.extrato');
    Route::post('investimento/{investimento}/guarda',  'guarda')
        ->name('investimento.guarda');
    Route::get('investimento/{investimento}/rendimento',  'indexRendimento')
        ->name('investimento.rendimento');
});
Route::controller(InvestimentoCdbController::class)->group(function () {
    Route::post('/investimento{investimento}/rendimento', 'storeRendimento')
        ->name('investimento.storeRendimento');
});
