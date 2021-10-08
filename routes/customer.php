<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'login'])->name('customer.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'oAuthLogin'])->name('customer.oAuthLogin');
Route::post('logout', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'logout'])->name('customer.logout');

Route::middleware([
    'auth:customer'
])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Web\Customer\DashboardController::class, 'index'])->name('customer.dashboard.index');
});
