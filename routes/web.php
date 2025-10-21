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
    Route::prefix('/conta-bancaria')->group(function () {
        Route::get('/', [IndexContaBancariaController::class, 'index'])
            ->name('conta-bancaria.index');
        Route::post('/store', [StoreContaBancariaController::class, 'store'])
            ->name('conta-bancaria.store');
        Route::get('/show/{id}', [ShowContaBancariaController::class, 'show'])
            ->name('conta-bancaria.show');
        Route::put('/update/{id}', [UpdateContaBancariaController::class, 'update'])
            ->name('conta-bancaria.update');
        Route::delete('/delete/{id}', [DeleteContaBancariaController::class, 'delete'])
            ->name('conta-bancaria.delete');
    });

    //Investimento
    Route::prefix('/investimento')->group(function () {
        Route::get('/', [IndexInvestimentoController::class, 'index'])
            ->name('investimento.index');
        Route::post('/store', [StoreInvestimentoController::class, 'store'])
            ->name('investimento.store');
        Route::get('/show/{id}', [ShowInvestimentoController::class, 'show'])
            ->name('investimento.show');
    });

    //Investimento CDB
    Route::prefix('/investimento/cdb')->group(function () {
        Route::post('/guarda/{investimento}', [GuardaInvestimentoCdb::class, 'guarda'])
            ->name('investimentoCbd.guarda');

        Route::get('/{investimento}', [IndexAddRendimentoCdb::class, 'indexAddRendimentoCdb'])
            ->name('investimentoCdb.indexAddRendimentoCdb');

        Route::post('/{investimento}', [InsertRendimentoCdb::class, 'insertRendimentoCdb'])
            ->name('investimentoCdb.insertRendimentoCdb');

        Route::get('/extrato/{investimento}', [ExtratoCompletoCdb::class, 'extratoCompletoCdb'])
            ->name('investimentoCdb.extratoCompletoCdb');
            
    });
});
