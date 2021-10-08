<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'login'])->name('login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'oAuthLogin'])->name('oAuthLogin');

Route::middleware([
    'auth:user'
])->group(function () {
    Route::get('dashboard', function () {
        return 'User Dashboard';
    })->name('dashboard.index');
});
