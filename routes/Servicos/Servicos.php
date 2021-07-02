<?php

use App\Http\Controllers\Servico\ServicoController;
use Illuminate\Support\Facades\Route;

Route::post('/store', [ServicoController::class, 'store'])->name('store');
Route::post('/update/{id}', [ServicoController::class, 'update'])->name('update');
Route::post('/getServico', [ServicoController::class, 'getServico'])->name('getServico');

Route::Delete('/destroy/{id}', [ServicoController::class, 'destroy'])->name('destroy');
