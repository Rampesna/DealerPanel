<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\Dealer\AuthenticationController::class, 'login'])->name('login');
