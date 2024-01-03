<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Saldo\SaldoController;
use App\Http\Controllers\Servico\ServicoController;
use App\Http\Controllers\Todo\TodoController;
use App\Http\Controllers\Exercise\WeightController;
use App\Http\Controllers\Moto\MotoController;

Route::resource('clientes', ClienteController::class);
Route::post('clientes/getClientes', [ClienteController::class, 'getClientes'])->name('getClientes');

Route::resource('servicos', ServicoController::class);
Route::post('servicos/getServico', [ServicoController::class, 'getServico'])->name('getServico');

route::post('saldo', [SaldoController::class, 'saldo'])->name('saldo');

Route::resource('todo', TodoController::class);
Route::get('getprioridades', [TodoController::class, 'getprioridades'])->name('getprioridades');
Route::get('getafazeres', [TodoController::class, 'getafazeres'])->name('getafazeres');
Route::get('getafazeresfinalizados', [TodoController::class, 'getafazeresfinalizados'])->name('getafazeresfinalizados');


Route::post('login', [AuthController::class, 'login']);
Route::post('create-user', [AuthController::class, 'createUsers']);

Route::middleware('auth:api')->group(function () {

  Route::get('check-auth', [AuthController::class, 'checkAuth']);
  Route::prefix('{user}')->group(function () {
    Route::post('update-user', [AuthController::class, 'updateUser']);
  });

  Route::prefix('weight')->group(function () {
    Route::get('', [WeightController::class, 'getWeight']);
    Route::post('', [WeightController::class, 'createWeight']);
    Route::put('{weight}', [WeightController::class, 'editWeight']);
    Route::delete('{weight}', [WeightController::class, 'deleteWeight']);
  });

  Route::prefix('moto')->group(function () {
    Route::prefix('kms')->group(function () {
      Route::get('', [MotoController::class, 'getKms']);
      Route::post('', [MotoController::class, 'createKms']);
      Route::put('{km}', [MotoController::class, 'editKms']);
      Route::delete('{km}', [MotoController::class, 'deleteKms']);
    });
  });
});
