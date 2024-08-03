<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('conta', [AccountController::class, 'store'])->name('conta.store');
Route::get('conta', [AccountController::class, 'show'])->name('conta.show');

Route::post('transacao', [TransactionController::class, 'store'])->name('transacao.store');

