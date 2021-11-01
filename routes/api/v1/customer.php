<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\Customer\AuthenticationController::class, 'login'])->name('api.v1.customer.auth.login');
});

Route::middleware([
    'CheckHeaderToken',
    'CheckHeaderAuthType',
    'CheckCustomer',
])->group(function () {

    Route::prefix('service')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\Customer\ServiceController::class, 'index'])->name('api.v1.customer.service.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\Customer\ServiceController::class, 'datatable'])->name('api.v1.customer.service.datatable')->middleware(['CheckMethod:get']);
    });

    Route::prefix('credit')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\Customer\CreditController::class, 'index'])->name('api.v1.customer.credit.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\Customer\CreditController::class, 'datatable'])->name('api.v1.customer.credit.datatable')->middleware(['CheckMethod:get']);
    });

    Route::prefix('receipt')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\Customer\ReceiptController::class, 'index'])->name('api.v1.customer.receipt.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\Customer\ReceiptController::class, 'datatable'])->name('api.v1.customer.receipt.datatable')->middleware(['CheckMethod:get']);
    });

    Route::prefix('supportRequest')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\Customer\SupportRequestController::class, 'index'])->name('api.v1.customer.supportRequest.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\Customer\SupportRequestController::class, 'datatable'])->name('api.v1.customer.supportRequest.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\Customer\SupportRequestController::class, 'show'])->name('api.v1.customer.supportRequest.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\Customer\SupportRequestController::class, 'save'])->name('api.v1.customer.supportRequest.save')->middleware(['CheckMethod:post|put']);
        Route::any('updateStatus', [\App\Http\Controllers\Api\Customer\SupportRequestController::class, 'updateStatus'])->name('api.v1.customer.supportRequest.updateStatus')->middleware(['CheckMethod:put']);
    });

    Route::prefix('supportRequestMessage')->group(function () {
        Route::any('save', [\App\Http\Controllers\Api\Customer\SupportRequestMessageController::class, 'save'])->name('api.v1.customer.supportRequestMessage.save')->middleware(['CheckMethod:post|put']);
    });

    Route::prefix('password')->group(function () {
        Route::any('check', [\App\Http\Controllers\Api\Customer\PasswordController::class, 'check'])->name('api.v1.customer.password.check')->middleware(['CheckMethod:get']);
        Route::any('update', [\App\Http\Controllers\Api\Customer\PasswordController::class, 'update'])->name('api.v1.customer.password.update')->middleware(['CheckMethod:post']);
    });
});
