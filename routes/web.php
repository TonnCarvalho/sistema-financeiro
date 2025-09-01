<?php

use App\Http\Controllers\ContaBancariaController;
use App\Http\Controllers\InvestimentoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    Auth::loginUsingId(1);
    $login = Auth::id();
    return view('dashboard.dashboard', ['login' => $login]);
})->name('dashboard');

Route::resource('conta-bancaria', ContaBancariaController::class)->names([
    'index' => 'conta-bancaria.index',
    'store' => 'conta-bancaria.store',
    'show' => 'conta-bancaria.show',
    'edit' => 'conta-bancaria.edit',
    'update' => 'conta-bancaria.update'
]);

Route::resource('investimento', InvestimentoController::class)->names([
    'index' => 'investimento.index'
]);
