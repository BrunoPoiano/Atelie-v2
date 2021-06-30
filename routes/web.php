<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Servico\ServicoController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/clientes')->name('clientes.')->group(base_path('routes/Clientes/Clientes.php'));

Route::prefix('/servicos')->name('servicos.')->group(base_path('routes/Servicos/Servicos.php'));