<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\DealerUser\AuthenticationController::class, 'login'])->name('api.v1.dealerUser.auth.login');
});

Route::middleware([
    'CheckHeaderToken',
    'CheckHeaderAuthType',
    'CheckDealerUser',
])->group(function () {

    Route::prefix('customer')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'index'])->name('api.v1.dealerUser.customer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'datatable'])->name('api.v1.dealerUser.customer.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'show'])->name('api.v1.dealerUser.customer.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'save'])->name('api.v1.dealerUser.customer.save')->middleware(['CheckMethod:post|put']);

        Route::prefix('service')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\DealerUser\CustomerServiceController::class, 'index'])->name('api.v1.dealerUser.customer.service.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerServiceController::class, 'datatable'])->name('api.v1.dealerUser.customer.service.datatable')->middleware(['CheckMethod:get']);
        });
    });
});
