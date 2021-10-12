<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'login'])->name('user.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'oAuthLogin'])->name('user.oAuthLogin');
Route::post('logout', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'logout'])->name('user.logout');

Route::middleware([
    'auth:user'
])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Web\User\DashboardController::class, 'index'])->name('user.dashboard.index');

    Route::prefix('dealer')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\DealerController::class, 'index'])->name('user.dealer.index');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\Web\User\DealerController::class, 'show'])->name('user.dealer.show');
    });

    Route::prefix('customer')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CustomerController::class, 'index'])->name('user.customer.index');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\Web\User\CustomerController::class, 'show'])->name('user.customer.show');
    });

    Route::prefix('supportRequest')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SupportRequestController::class, 'index'])->name('user.supportRequest.index');
        Route::get('show/{id?}', [\App\Http\Controllers\Web\User\SupportRequestController::class, 'show'])->name('user.supportRequest.show');
    });
});
