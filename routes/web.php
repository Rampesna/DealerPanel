<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dealerUser.login');
});

Route::get('/test', function () {
    return base64_encode('98765432100');
});
