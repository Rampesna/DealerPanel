<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'login'])->name('user.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'oAuthLogin'])->name('user.oAuthLogin');
Route::post('logout', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'logout'])->name('user.logout');

Route::middleware([
    'auth:user'
])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Web\User\DashboardController::class, 'index'])->name('user.dashboard.index');
});
