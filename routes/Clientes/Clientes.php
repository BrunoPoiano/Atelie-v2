<?php

use App\Http\Controllers\Cliente\ClienteController;
use Illuminate\Support\Facades\Route;

route::post('/store', [ClienteController::class, 'store'])->name('store');

route::get('/getClientes', [ClienteController::class, 'getClientes'])->name('getClientes');

route::post('/editar/{id}', [ClienteController::class, 'editar'])->name('editar');

route::delete('/apagar/{id}', [ClienteController::class, 'apagar'])->name('apagar');
