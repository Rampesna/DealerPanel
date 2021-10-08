<?php

use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    return (new \App\Services\CustomerService)->datatable(1);
});
