<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\User\AuthenticationController::class, 'login'])->name('api.v1.user.auth.login');
});
