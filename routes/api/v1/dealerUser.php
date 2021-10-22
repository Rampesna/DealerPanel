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
            Route::any('index', [\App\Http\Controllers\Api\DealerUser\RelationServiceController::class, 'index'])->name('api.v1.dealerUser.customer.service.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\RelationServiceController::class, 'datatable'])->name('api.v1.dealerUser.customer.service.datatable')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\DealerUser\RelationServiceController::class, 'save'])->name('api.v1.dealerUser.customer.service.save')->middleware(['CheckMethod:post']);
            Route::any('updateTransactionStatus', [\App\Http\Controllers\Api\DealerUser\RelationServiceController::class, 'updateTransactionStatus'])->name('api.v1.dealerUser.customer.service.updateTransactionStatus')->middleware(['CheckMethod:put']);
        });

        Route::prefix('credit')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\DealerUser\CreditController::class, 'index'])->name('api.v1.dealerUser.customer.credit.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CreditController::class, 'datatable'])->name('api.v1.dealerUser.customer.credit.datatable')->middleware(['CheckMethod:get']);
        });

        Route::prefix('receipt')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\DealerUser\CustomerReceiptController::class, 'index'])->name('api.v1.dealerUser.customer.receipt.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerReceiptController::class, 'datatable'])->name('api.v1.dealerUser.customer.receipt.datatable')->middleware(['CheckMethod:get']);
        });

        Route::prefix('supportRequest')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CustomerSupportRequestController::class, 'datatable'])->name('api.v1.dealerUser.customer.supportRequest.datatable')->middleware(['CheckMethod:get']);
        });
    });

    Route::prefix('dealer')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\DealerController::class, 'index'])->name('api.v1.dealerUser.dealer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\DealerController::class, 'datatable'])->name('api.v1.dealerUser.dealer.datatable')->middleware(['CheckMethod:get']);
    });

    Route::prefix('supportRequest')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'index'])->name('api.v1.dealerUser.supportRequest.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'datatable'])->name('api.v1.dealerUser.supportRequest.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'show'])->name('api.v1.dealerUser.supportRequest.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'save'])->name('api.v1.dealerUser.supportRequest.save')->middleware(['CheckMethod:post|put']);
        Route::any('updateStatus', [\App\Http\Controllers\Api\DealerUser\SupportRequestController::class, 'updateStatus'])->name('api.v1.dealerUser.supportRequest.updateStatus')->middleware(['CheckMethod:put']);
    });

    Route::prefix('credit')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\CreditController::class, 'index'])->name('api.v1.dealerUser.credit.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\CreditController::class, 'datatable'])->name('api.v1.dealerUser.credit.datatable')->middleware(['CheckMethod:get']);
    });

    Route::prefix('receipt')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\ReceiptController::class, 'index'])->name('api.v1.dealerUser.receipt.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\ReceiptController::class, 'datatable'])->name('api.v1.dealerUser.receipt.datatable')->middleware(['CheckMethod:get']);
    });

    Route::prefix('opportunity')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\DealerUser\OpportunityController::class, 'index'])->name('api.v1.dealerUser.opportunity.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\DealerUser\OpportunityController::class, 'datatable'])->name('api.v1.dealerUser.opportunity.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\DealerUser\OpportunityController::class, 'show'])->name('api.v1.dealerUser.opportunity.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\OpportunityController::class, 'save'])->name('api.v1.dealerUser.opportunity.save')->middleware(['CheckMethod:post|put']);
    });

    Route::prefix('supportRequestMessage')->group(function () {
        Route::any('save', [\App\Http\Controllers\Api\DealerUser\SupportRequestMessageController::class, 'save'])->name('api.v1.dealerUser.supportRequestMessage.save')->middleware(['CheckMethod:post|put']);
    });
});
