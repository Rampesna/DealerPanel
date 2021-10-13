<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\DealerUser\AuthenticationController::class, 'login'])->name('api.v1.dealerUser.auth.login');
});

Route::middleware([
    'CheckHeaderToken',
    'CheckHeaderAuthType',
    'CheckDealerUser',
])->group(function () {

    Route::prefix('customer')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'index'])->name('api.v1.dealerUser.customer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'datatable'])->name('api.v1.dealerUser.customer.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'show'])->name('api.v1.dealerUser.customer.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\CustomerController::class, 'save'])->name('api.v1.dealerUser.customer.save')->middleware(['CheckMethod:post|put']);

        Route::prefix('service')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\DealerUser\CustomerServiceController::class, 'index'])->name('api.v1.dealerUser.customer.service.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerServiceController::class, 'datatable'])->name('api.v1.dealerUser.customer.service.datatable')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\DealerUser\CustomerServiceController::class, 'save'])->name('api.v1.dealerUser.customer.service.save')->middleware(['CheckMethod:post']);
        });

        Route::prefix('supportRequest')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerSupportRequestController::class, 'datatable'])->name('api.v1.dealerUser.customer.supportRequest.datatable')->middleware(['CheckMethod:get']);
        });
    });

    Route::prefix('waitingTransaction')->group(function () {
        Route::prefix('customer')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\WaitingTransaction\CustomerController::class, 'datatable'])->name('api.v1.dealerUser.waitingTransaction.customer.datatable')->middleware(['CheckMethod:get']);
        });

        Route::prefix('credit')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\WaitingTransaction\CreditController::class, 'datatable'])->name('api.v1.dealerUser.waitingTransaction.credit.datatable')->middleware(['CheckMethod:get']);
        });
    });

    Route::prefix('supportRequest')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'index'])->name('api.v1.dealerUser.supportRequest.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'datatable'])->name('api.v1.dealerUser.supportRequest.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'show'])->name('api.v1.dealerUser.supportRequest.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'save'])->name('api.v1.dealerUser.supportRequest.save')->middleware(['CheckMethod:post|put']);
        Route::any('updateStatus', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'updateStatus'])->name('api.v1.dealerUser.supportRequest.updateStatus')->middleware(['CheckMethod:put']);
    });

    Route::prefix('supportRequestMessage')->group(function () {
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\SupportRequestMessageController::class, 'save'])->name('api.v1.dealerUser.supportRequestMessage.save')->middleware(['CheckMethod:post|put']);
    });
});
