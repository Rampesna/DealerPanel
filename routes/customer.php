<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'login'])->name('customer.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'oAuthLogin'])->name('customer.oAuthLogin');
Route::get('oAuthLoginWithTaxNumber', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'oAuthLoginWithTaxNumber'])->name('customer.oAuthLoginWithTaxNumber');
Route::post('logout', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'logout'])->name('customer.logout');

Route::middleware([
    'auth:customer'
])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Web\Customer\DashboardController::class, 'index'])->name('customer.dashboard.index');

    Route::get('credit', [\App\Http\Controllers\Web\Customer\CreditController::class, 'index'])->name('customer.credit.index');

    Route::get('finance', [\App\Http\Controllers\Web\Customer\FinanceController::class, 'index'])->name('customer.finance.index');

    Route::get('service', [\App\Http\Controllers\Web\Customer\ServiceController::class, 'index'])->name('customer.service.index');

    Route::prefix('supportRequest')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\Customer\SupportRequestController::class, 'index'])->name('customer.supportRequest.index');
        Route::get('show/{id?}', [\App\Http\Controllers\Web\Customer\SupportRequestController::class, 'show'])->name('customer.supportRequest.show');
    });
});
