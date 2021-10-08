<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return bcrypt('admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
