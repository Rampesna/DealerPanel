<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'login'])->name('user.login');
Route::post('oAuthLogin', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'oAuthLogin'])->name('user.oAuthLogin');
Route::post('logout', [\App\Http\Controllers\Web\User\AuthenticationController::class, 'logout'])->name('user.logout');

Route::middleware([
    'auth:user'
])->group(function () {
    Route::get('profile', [\App\Http\Controllers\Web\User\ProfileController::class, 'index'])->name('user.profile.index');

    Route::get('dashboard', [\App\Http\Controllers\Web\User\DashboardController::class, 'index'])->name('user.dashboard.index');

    Route::prefix('dealer')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\DealerController::class, 'index'])->name('user.dealer.index');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\Web\User\DealerController::class, 'show'])->name('user.dealer.show');
    });

    Route::prefix('customer')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\CustomerController::class, 'index'])->name('user.customer.index');
        Route::get('show/{id?}/{tab?}', [\App\Http\Controllers\Web\User\CustomerController::class, 'show'])->name('user.customer.show');
    });

    Route::get('opportunity', [\App\Http\Controllers\Web\User\OpportunityController::class, 'index'])->name('user.opportunity.index');

    Route::prefix('waitingTransaction')->group(function () {
        Route::get('{tab?}', [\App\Http\Controllers\Web\User\WaitingTransactionController::class, 'show'])->name('user.waitingTransaction.show');
    });

    Route::get('batchTransaction', [\App\Http\Controllers\Web\User\BatchTransactionController::class, 'index'])->name('user.batchTransaction.index');

    Route::prefix('supportRequest')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\SupportRequestController::class, 'index'])->name('user.supportRequest.index');
        Route::get('show/{id?}', [\App\Http\Controllers\Web\User\SupportRequestController::class, 'show'])->name('user.supportRequest.show');
    });

    Route::prefix('report')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ReportController::class, 'index'])->name('user.report.index');
        Route::get('show/{report?}', [\App\Http\Controllers\Web\User\ReportController::class, 'show'])->name('user.report.show');
    });

    Route::prefix('user')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\UserController::class, 'index'])->name('user.user.index');
    });

    Route::prefix('log')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\LogController::class, 'index'])->name('user.log.index');
    });

    Route::prefix('service')->group(function () {
        Route::get('index', [\App\Http\Controllers\Web\User\ServiceController::class, 'index'])->name('user.service.index');
    });

    Route::get('connections', [\App\Http\Controllers\Web\User\TestController::class, 'index'])->name('user.test.post');

});
