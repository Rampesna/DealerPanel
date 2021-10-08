<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\Customer\AuthenticationController::class, 'login'])->name('login');
