<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dealerUser.login');
});

Route::get('/test', function () {
    return (new \App\Services\DealerService)->jsTree([4]);
});
