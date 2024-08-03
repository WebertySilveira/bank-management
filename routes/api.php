<?php

use App\Http\Controllers\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('conta', [AccountController::class, 'store'])->name('conta.store');
Route::get('conta', [AccountController::class, 'show'])->name('conta.show');
