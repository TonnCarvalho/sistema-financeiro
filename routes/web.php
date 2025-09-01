<?php

use App\Http\Controllers\ContaBancariaController;
use App\Http\Controllers\InvestimentoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Auth::loginUsingId(1);
    $login = Auth::id();
    return view(
        'dashboard.dashboard',
        compact('login'));
})->name('dashboard');

Route::resource('conta-bancaria', ContaBancariaController::class)
    ->names([
        'index' => 'conta-bancaria.index',
        'store' => 'conta-bancaria.store',
        'show' => 'conta-bancaria.show',
        'update' => 'conta-bancaria.update',
        'destroy' => 'conta-bancaria.destroy'
    ]);

Route::resource('investimento', InvestimentoController::class)->names([
    'index' => 'investimento.index'
]);
