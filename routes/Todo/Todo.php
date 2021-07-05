<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo\TodoController;

Route::post('/store', [TodoController::class, 'store'])->name('store');

Route::get('/getprioridades', [TodoController::class, 'getprioridades'])->name('getprioridades');
Route::get('/getafazeres', [TodoController::class, 'getafazeres'])->name('getafazeres');
Route::get('/getafazeresfinalizados', [TodoController::class, 'getafazeresfinalizados'])->name('getafazeresfinalizados');

Route::delete('/delete/{id}', [TodoController::class, 'delete'])->name('delete');
Route::put('/update/{id}', [TodoController::class, 'update'])->name('update');
