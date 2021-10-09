<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\Dealer\AuthenticationController::class, 'login'])->name('api.v1.dealer.auth.login');
});

Route::middleware([
    'CheckToken:dealer',
])->group(function () {

    Route::prefix('customer')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\Dealer\CustomerController::class, 'index'])->name('api.v1.dealer.customer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\Dealer\CustomerController::class, 'datatable'])->name('api.v1.dealer.customer.datatable')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\Dealer\CustomerController::class, 'save'])->name('api.v1.dealer.customer.save')->middleware(['CheckMethod:post,put']);
    });
});
