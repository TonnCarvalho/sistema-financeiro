<?php

use App\Http\Controllers\Auth\AuthLoginController;
use App\Http\Controllers\Auth\IndexLoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestimentoCdb\ExtratoCompletoCdb;
use App\Http\Controllers\InvestimentoCdb\InsertRendimentoCdb;
use App\Http\Controllers\InvestimentoCdb\GuardaInvestimentoCdb;
use App\Http\Controllers\InvestimentoCdb\IndexAddRendimentoCdb;
use App\Http\Controllers\Investimento\ShowInvestimentoController;
use App\Http\Controllers\Investimento\IndexInvestimentoController;
use App\Http\Controllers\Investimento\StoreInvestimentoController;
use App\Http\Controllers\ContaBancaria\ShowContaBancariaController;
use App\Http\Controllers\ContaBancaria\IndexContaBancariaController;
use App\Http\Controllers\ContaBancaria\StoreContaBancariaController;
use App\Http\Controllers\ContaBancaria\DeleteContaBancariaController;
use App\Http\Controllers\ContaBancaria\UpdateContaBancariaController;
use App\Http\Middleware\Auth\IsLogin;
use App\Http\Middleware\Auth\NotLogin;

//Middleware para verificar se já está logado e não ir para pagina de login
Route::middleware([IsLogin::class])->group(function () {
    //Login
    Route::get('/login', [IndexLoginController::class, 'index'])
        ->name('auth.login');
    Route::post('login', [AuthLoginController::class, 'authLogin'])
        ->name('auth.authLogin');
});

//Middleware validação se está logado.
Route::middleware([NotLogin::class])->group(function () {

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])
        ->name('auth.logout');
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
    Route::get('/investimento', [IndexInvestimentoController::class, 'index'])
        ->name('investimento.index');
    Route::get('/investimento/store', [StoreInvestimentoController::class, 'store'])
        ->name('investimento.store');
    Route::get('/investimento/show/{id}', [ShowInvestimentoController::class, 'show'])
        ->name('investimento.show');

    //Investimento CDB
    Route::get('/investimento/cdb/guarda/{investimento}', [GuardaInvestimentoCdb::class, 'guarda'])
        ->name('investimentoCbd.guarda');
    Route::get('/investimento/cdb/{investimento}', [IndexAddRendimentoCdb::class, 'indexAddRendimentoCdb'])
        ->name('investimentoCdb.indexAddRendimentoCdb');
    Route::post('/investimento/cdb/{investimento}', [InsertRendimentoCdb::class, 'insertRendimentoCdb'])
        ->name('investimentoCdb.insertRendimentoCdb');
    Route::get('/investimento/cdb/extrato/{investimento}', [ExtratoCompletoCdb::class, 'extratoCompletoCdb'])
        ->name('investimentoCdb.extratoCompletoCdb');
});
