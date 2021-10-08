<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::prefix('login')->group(function () {
        Route::any('customer', [\App\Http\Controllers\Api\Auth\CustomerAuthenticationController::class, 'login'])->name('api.v1.auth.login.customer');
        Route::any('dealer', [\App\Http\Controllers\Api\Auth\DealerAuthenticationController::class, 'login'])->name('api.v1.auth.login.dealer');
        Route::any('user', [\App\Http\Controllers\Api\Auth\UserAuthenticationController::class, 'login'])->name('api.v1.auth.login.user');
    });
});
