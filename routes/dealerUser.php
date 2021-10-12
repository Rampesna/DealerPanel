<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\DealerUser\AuthenticationController::class, 'login'])->name('dealerUser.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\DealerUser\AuthenticationController::class, 'oAuthLogin'])->name('dealerUser.oAuthLogin');
Route::post('logout', [\App\Http\Controllers\Web\DealerUser\AuthenticationController::class, 'logout'])->name('dealerUser.logout');

Route::middleware([
    'auth:dealerUser'
])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Web\DealerUser\DashboardController::class, 'index'])->name('dealerUser.dashboard.index');

    Route::prefix('customer')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\DealerUser\CustomerController::class, 'index'])->name('dealerUser.customer.index');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\Web\DealerUser\CustomerController::class, 'show'])->name('dealerUser.customer.show');
    });

    Route::prefix('waitingTransaction')->group(function () {
        Route::get('{tab?}', [\App\Http\Controllers\Web\DealerUser\WaitingTransactionController::class, 'show'])->name('dealerUser.waitingTransaction.show');
    });

    Route::get('finance', [\App\Http\Controllers\Web\DealerUser\FinanceController::class, 'index'])->name('dealerUser.finance.index');

    Route::prefix('supportRequest')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\DealerUser\SupportRequestController::class, 'index'])->name('dealerUser.supportRequest.index');
        Route::get('show/{id?}', [\App\Http\Controllers\Web\DealerUser\SupportRequestController::class, 'show'])->name('dealerUser.supportRequest.show');
    });
});
