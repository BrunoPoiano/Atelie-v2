<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Servico\ServicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/clientes')->name('clientes.')->group(base_path('routes/Clientes/Clientes.php'));

Route::prefix('/servicos')->name('servicos.')->group(base_path('routes/Servicos/Servicos.php'));

Route::prefix('/saldo')->name('saldo.')->group(base_path('routes/Saldo/Saldo.php'));

Route::prefix('/todo')->name('todo.')->group(base_path('routes/Todo/Todo.php'));