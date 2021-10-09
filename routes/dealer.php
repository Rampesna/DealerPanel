<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\Dealer\AuthenticationController::class, 'login'])->name('dealer.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\Dealer\AuthenticationController::class, 'oAuthLogin'])->name('dealer.oAuthLogin');
Route::post('logout', [\App\Http\Controllers\Web\Dealer\AuthenticationController::class, 'logout'])->name('dealer.logout');

Route::middleware([
    'auth:dealer'
])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Web\Dealer\DashboardController::class, 'index'])->name('dealer.dashboard.index');

    Route::prefix('customer')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Dealer\CustomerController::class, 'index'])->name('dealer.customer.index');
    });
});
