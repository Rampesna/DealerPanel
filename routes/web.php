<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dealerUser.login');
});

Route::get('/test', function () {
    return \App\Models\Customer::find(1)->services;
});
