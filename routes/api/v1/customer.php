<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\Customer\AuthenticationController::class, 'login'])->name('api.v1.customer.auth.login');
});
