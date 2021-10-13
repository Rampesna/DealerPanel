<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\User\AuthenticationController::class, 'login'])->name('api.v1.user.auth.login');
});

Route::middleware([
    'CheckHeaderToken',
    'CheckHeaderAuthType',
    'CheckUser',
])->group(function () {

    Route::prefix('dealer')->group(function () {
        Route::any('all', [\App\Http\Controllers\Api\User\DealerController::class, 'all'])->name('api.v1.user.dealer.all')->middleware(['CheckMethod:get']);
        Route::any('index', [\App\Http\Controllers\Api\User\DealerController::class, 'index'])->name('api.v1.user.dealer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\DealerController::class, 'datatable'])->name('api.v1.user.dealer.datatable')->middleware(['CheckMethod:get']);
        Route::any('jsTree', [\App\Http\Controllers\Api\User\DealerController::class, 'jsTree'])->name('api.v1.user.dealer.jsTree')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\DealerController::class, 'show'])->name('api.v1.user.dealer.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\DealerController::class, 'save'])->name('api.v1.user.dealer.save')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\DealerController::class, 'drop'])->name('api.v1.user.dealer.drop')->middleware(['CheckMethod:delete']);
    });

    Route::prefix('customer')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\CustomerController::class, 'index'])->name('api.v1.user.customer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerController::class, 'datatable'])->name('api.v1.user.customer.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\CustomerController::class, 'show'])->name('api.v1.user.customer.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\CustomerController::class, 'save'])->name('api.v1.user.customer.save')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\CustomerController::class, 'drop'])->name('api.v1.user.customer.drop')->middleware(['CheckMethod:delete']);

        Route::prefix('service')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\CustomerServiceController::class, 'index'])->name('api.v1.user.customer.service.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerServiceController::class, 'datatable'])->name('api.v1.user.customer.service.datatable')->middleware(['CheckMethod:get']);
            Route::any('show', [\App\Http\Controllers\Api\User\CustomerServiceController::class, 'show'])->name('api.v1.user.customer.service.show')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\CustomerServiceController::class, 'save'])->name('api.v1.user.customer.service.save')->middleware(['CheckMethod:post|put']);
            Route::any('drop', [\App\Http\Controllers\Api\User\CustomerServiceController::class, 'drop'])->name('api.v1.user.customer.service.drop')->middleware(['CheckMethod:delete']);
        });

        Route::prefix('supportRequest')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerSupportRequestController::class, 'datatable'])->name('api.v1.user.customer.supportRequest.datatable')->middleware(['CheckMethod:get']);
        });
    });

    Route::prefix('waitingTransaction')->group(function () {
        Route::prefix('customer')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\WaitingTransaction\CustomerController::class, 'datatable'])->name('api.v1.user.waitingTransaction.customer.datatable')->middleware(['CheckMethod:get']);
            Route::any('accept', [\App\Http\Controllers\Api\User\WaitingTransaction\CustomerController::class, 'accept'])->name('api.v1.user.waitingTransaction.customer.accept')->middleware(['CheckMethod:put']);
        });

        Route::prefix('credit')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\WaitingTransaction\CreditController::class, 'datatable'])->name('api.v1.user.waitingTransaction.credit.datatable')->middleware(['CheckMethod:get']);
        });
    });

    Route::prefix('supportRequest')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\SupportRequestController::class, 'index'])->name('api.v1.user.supportRequest.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\SupportRequestController::class, 'datatable'])->name('api.v1.user.supportRequest.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\SupportRequestController::class, 'show'])->name('api.v1.user.supportRequest.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\SupportRequestController::class, 'save'])->name('api.v1.user.supportRequest.save')->middleware(['CheckMethod:post|put']);
        Route::any('updateStatus', [\App\Http\Controllers\Api\User\SupportRequestController::class, 'updateStatus'])->name('api.v1.user.supportRequest.updateStatus')->middleware(['CheckMethod:put']);
    });

    Route::prefix('supportRequestMessage')->group(function () {
        Route::any('save', [\App\Http\Controllers\Api\User\SupportRequestMessageController::class, 'save'])->name('api.v1.user.supportRequestMessage.save')->middleware(['CheckMethod:post|put']);
    });
});
