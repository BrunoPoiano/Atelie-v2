<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Saldo\SaldoController;
use App\Http\Controllers\Servico\ServicoController;
use App\Http\Controllers\Todo\TodoController;

Route::resource('clientes', ClienteController::class);
Route::post('clientes/getClientes', [ClienteController::class, 'getClientes'])->name('getClientes');

Route::resource('servicos', ServicoController::class);
Route::post('servicos/getServico', [ServicoController::class, 'getServico'])->name('getServico');

route::post('saldo', [SaldoController::class, 'saldo'])->name('saldo');

Route::resource('todo', TodoController::class);
Route::get('getprioridades', [TodoController::class, 'getprioridades'])->name('getprioridades');
Route::get('getafazeres', [TodoController::class, 'getafazeres'])->name('getafazeres');
Route::get('getafazeresfinalizados', [TodoController::class, 'getafazeresfinalizados'])->name('getafazeresfinalizados');