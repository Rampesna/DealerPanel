<?php

use Illuminate\Support\Facades\Route;

Route::middleware([

])->group(function () {
    Route::prefix('customer')->group(function () {
        Route::any('checkTaxNumber', [\App\Http\Controllers\Api\General\CustomerController::class, 'checkTaxNumber'])
            ->name('api.v1.general.customer.checkTaxNumber')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('dealer')->group(function () {
        Route::any('checkTaxNumber', [\App\Http\Controllers\Api\General\DealerController::class, 'checkTaxNumber'])
            ->name('api.v1.general.dealer.checkTaxNumber')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('supportRequestCategory')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\General\SupportRequestCategoryController::class, 'index'])
            ->name('api.v1.general.supportRequestCategory.index')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('supportRequestPriority')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\General\SupportRequestPriorityController::class, 'index'])
            ->name('api.v1.general.supportRequestPriority.index')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('supportRequestStatus')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\General\SupportRequestStatusController::class, 'index'])
            ->name('api.v1.general.supportRequestStatus.index')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('service')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\General\ServiceController::class, 'index'])
            ->name('api.v1.general.service.index')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('relationServiceStatus')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\General\RelationServiceStatusController::class, 'index'])
            ->name('api.v1.general.relationServiceStatus.index')
            ->middleware(['CheckMethod:get']);
    });

    Route::prefix('contractStatus')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\General\ContractStatusController::class, 'index'])
            ->name('api.v1.general.contractStatus.index')
            ->middleware(['CheckMethod:get']);
    });
});
