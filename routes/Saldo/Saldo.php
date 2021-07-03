<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Saldo\SaldoController;


route::post('saldo', [SaldoController::class, 'saldo'])->name('saldo');