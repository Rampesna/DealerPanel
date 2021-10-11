<?php

use Illuminate\Support\Facades\Route;

Route::middleware([

])->group(function () {
    Route::prefix('customer')->group(function () {
        Route::any('checkTaxNumber', [\App\Http\Controllers\Api\General\CustomerController::class, 'checkTaxNumber'])
            ->name('api.v1.general.customer.checkTaxNumber')
            ->middleware(['CheckMethod:get']);
    });
});
