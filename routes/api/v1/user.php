<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::any('login', [\App\Http\Controllers\Api\User\AuthenticationController::class, 'login'])->name('api.v1.user.auth.login');
});

Route::middleware([
    'Cors',
    'CheckHeaderToken',
    'CheckHeaderAuthType',
    'CheckUser',
])->group(function () {

    Route::prefix('user')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\UserController::class, 'index'])->name('api.v1.user.user.index')->middleware(['CheckMethod:get']);
        Route::any('searching', [\App\Http\Controllers\Api\User\UserController::class, 'searching'])->name('api.v1.user.user.searching')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\UserController::class, 'datatable'])->name('api.v1.user.user.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\UserController::class, 'show'])->name('api.v1.user.user.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\UserController::class, 'save'])->name('api.v1.user.user.save')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\UserController::class, 'drop'])->name('api.v1.user.user.drop')->middleware(['CheckMethod:delete|DELETE']);
    });

    Route::prefix('credit')->group(function () {
        Route::any('deduction', [\App\Http\Controllers\Api\User\CreditController::class, 'deduction'])->name('api.v1.user.credit.deduction')->middleware(['CheckMethod:post|put']);

        Route::prefix('creditDetail')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\CreditDetailController::class, 'index'])->name('api.v1.user.credit.creditDetail.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\CreditDetailController::class, 'datatable'])->name('api.v1.user.credit.creditDetail.datatable')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\CreditDetailController::class, 'save'])->name('api.v1.user.credit.creditDetail.save')->middleware(['CheckMethod:post|put']);
        });
    });

    Route::prefix('bienSoapService')->group(function () {
        Route::get('usageReport', [\App\Http\Controllers\Api\User\BienSoapController::class, 'usageReport'])->name('api.v1.user.bienSoapService.usageReport')->middleware(['CheckMethod:get']);
        Route::get('usageListByCustomerId', [\App\Http\Controllers\Api\User\BienSoapController::class, 'usageListByCustomerId'])->name('api.v1.user.bienSoapService.usageListByCustomerId')->middleware(['CheckMethod:get']);
        Route::get('usageReportByCustomerId', [\App\Http\Controllers\Api\User\BienSoapController::class, 'usageReportByCustomerId'])->name('api.v1.user.bienSoapService.usageReportByCustomerId')->middleware(['CheckMethod:get']);
    });

    Route::prefix('creditDetailType')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\CreditDetailTypeController::class, 'index'])->name('api.v1.user.creditDetailType.index')->middleware(['CheckMethod:get']);
    });

    Route::prefix('receipt')->group(function () {
        Route::any('getPaid', [\App\Http\Controllers\Api\User\ReceiptController::class, 'getPaid'])->name('api.v1.user.receipt.getPaid')->middleware(['CheckMethod:post|put']);
    });

    Route::prefix('dealer')->group(function () {
        Route::any('all', [\App\Http\Controllers\Api\User\DealerController::class, 'all'])->name('api.v1.user.dealer.all')->middleware(['CheckMethod:get']);
        Route::any('index', [\App\Http\Controllers\Api\User\DealerController::class, 'index'])->name('api.v1.user.dealer.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\DealerController::class, 'datatable'])->name('api.v1.user.dealer.datatable')->middleware(['CheckMethod:get']);
        Route::any('jsTree', [\App\Http\Controllers\Api\User\DealerController::class, 'jsTree'])->name('api.v1.user.dealer.jsTree')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\DealerController::class, 'show'])->name('api.v1.user.dealer.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\DealerController::class, 'save'])->name('api.v1.user.dealer.save')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\DealerController::class, 'drop'])->name('api.v1.user.dealer.drop')->middleware(['CheckMethod:delete']);

        Route::prefix('service')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\DealerServiceController::class, 'index'])->name('api.v1.user.dealer.service.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\DealerServiceController::class, 'datatable'])->name('api.v1.user.dealer.service.datatable')->middleware(['CheckMethod:get']);
            Route::any('show', [\App\Http\Controllers\Api\User\DealerServiceController::class, 'show'])->name('api.v1.user.dealer.service.show')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\DealerServiceController::class, 'save'])->name('api.v1.user.dealer.service.save')->middleware(['CheckMethod:post|put']);
            Route::any('drop', [\App\Http\Controllers\Api\User\DealerServiceController::class, 'drop'])->name('api.v1.user.dealer.service.drop')->middleware(['CheckMethod:delete']);
        });

        Route::prefix('contract')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\DealerContractController::class, 'index'])->name('api.v1.user.dealer.contract.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\DealerContractController::class, 'datatable'])->name('api.v1.user.dealer.contract.datatable')->middleware(['CheckMethod:get']);
            Route::any('show', [\App\Http\Controllers\Api\User\DealerContractController::class, 'show'])->name('api.v1.user.dealer.contract.show')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\DealerContractController::class, 'save'])->name('api.v1.user.dealer.contract.save')->middleware(['CheckMethod:post|put']);
            Route::any('drop', [\App\Http\Controllers\Api\User\DealerContractController::class, 'drop'])->name('api.v1.user.dealer.contract.drop')->middleware(['CheckMethod:delete']);
            Route::any('uploadFile', [\App\Http\Controllers\Api\User\DealerContractController::class, 'uploadFile'])->name('api.v1.user.dealer.contract.uploadFile')->middleware(['CheckMethod:post']);

        });

        Route::prefix('dealerUser')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\DealerDealerUserController::class, 'index'])->name('api.v1.user.dealer.dealerUser.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\DealerDealerUserController::class, 'datatable'])->name('api.v1.user.dealer.dealerUser.datatable')->middleware(['CheckMethod:get']);
            Route::any('show', [\App\Http\Controllers\Api\User\DealerDealerUserController::class, 'show'])->name('api.v1.user.dealer.dealerUser.show')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\DealerDealerUserController::class, 'save'])->name('api.v1.user.dealer.dealerUser.save')->middleware(['CheckMethod:post|put']);
            Route::any('drop', [\App\Http\Controllers\Api\User\DealerDealerUserController::class, 'drop'])->name('api.v1.user.dealer.dealerUser.drop')->middleware(['CheckMethod:delete']);
            Route::any('sendPassword', [\App\Http\Controllers\Api\User\DealerDealerUserController::class, 'sendPassword'])->name('api.v1.user.dealer.dealerUser.sendPassword')->middleware(['CheckMethod:post|put']);
        });

        Route::prefix('credit')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\DealerCreditController::class, 'index'])->name('api.v1.user.dealer.credit.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\DealerCreditController::class, 'datatable'])->name('api.v1.user.dealer.credit.datatable')->middleware(['CheckMethod:get']);
        });

        Route::prefix('receipt')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\DealerReceiptController::class, 'index'])->name('api.v1.user.dealer.receipt.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\DealerReceiptController::class, 'datatable'])->name('api.v1.user.dealer.receipt.datatable')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\DealerReceiptController::class, 'save'])->name('api.v1.user.dealer.receipt.save')->middleware(['CheckMethod:post|put']);
        });
    });

    Route::prefix('customer')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\CustomerController::class, 'index'])->name('api.v1.user.customer.index')->middleware(['CheckMethod:get']);
        Route::any('indexWithServices', [\App\Http\Controllers\Api\User\CustomerController::class, 'indexWithServices'])->name('api.v1.user.customer.indexWithServices')->middleware(['CheckMethod:get']);
        Route::any('searching', [\App\Http\Controllers\Api\User\CustomerController::class, 'searching'])->name('api.v1.user.customer.searching')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerController::class, 'datatable'])->name('api.v1.user.customer.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\CustomerController::class, 'show'])->name('api.v1.user.customer.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\CustomerController::class, 'save'])->name('api.v1.user.customer.save')->middleware(['CheckMethod:post|put']);
        Route::any('importWithExcel', [\App\Http\Controllers\Api\User\CustomerController::class, 'importWithExcel'])->name('api.v1.user.customer.importWithExcel')->middleware(['CheckMethod:post']);
        Route::any('drop', [\App\Http\Controllers\Api\User\CustomerController::class, 'drop'])->name('api.v1.user.customer.drop')->middleware(['CheckMethod:delete|DELETE']);
        Route::any('updateDealer', [\App\Http\Controllers\Api\User\CustomerController::class, 'updateDealer'])->name('api.v1.user.customer.updateDealer')->middleware(['CheckMethod:post|put']);

        Route::prefix('service')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\RelationServiceController::class, 'index'])->name('api.v1.user.customer.service.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\RelationServiceController::class, 'datatable'])->name('api.v1.user.customer.service.datatable')->middleware(['CheckMethod:get']);
            Route::any('show', [\App\Http\Controllers\Api\User\RelationServiceController::class, 'show'])->name('api.v1.user.customer.service.show')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\RelationServiceController::class, 'save'])->name('api.v1.user.customer.service.save')->middleware(['CheckMethod:post|put']);
            Route::any('drop', [\App\Http\Controllers\Api\User\RelationServiceController::class, 'drop'])->name('api.v1.user.customer.service.drop')->middleware(['CheckMethod:delete']);
        });

        Route::prefix('supportRequest')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerSupportRequestController::class, 'datatable'])->name('api.v1.user.customer.supportRequest.datatable')->middleware(['CheckMethod:get']);
        });

        Route::prefix('credit')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\CustomerCreditController::class, 'index'])->name('api.v1.user.customer.credit.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerCreditController::class, 'datatable'])->name('api.v1.user.customer.credit.datatable')->middleware(['CheckMethod:get']);
        });

        Route::prefix('receipt')->group(function () {
            Route::any('index', [\App\Http\Controllers\Api\User\CustomerReceiptController::class, 'index'])->name('api.v1.user.customer.receipt.index')->middleware(['CheckMethod:get']);
            Route::any('datatable', [\App\Http\Controllers\Api\User\CustomerReceiptController::class, 'datatable'])->name('api.v1.user.customer.receipt.datatable')->middleware(['CheckMethod:get']);
            Route::any('save', [\App\Http\Controllers\Api\User\CustomerReceiptController::class, 'save'])->name('api.v1.user.customer.receipt.save')->middleware(['CheckMethod:post|put']);
        });
    });

    Route::prefix('opportunity')->group(function () {
        Route::any('test', [\App\Http\Controllers\Api\User\OpportunityController::class, 'index'])->name('api.v1.user.opportunity.test')->middleware(['CheckMethod:get', 'TestUserHeaderCheck']);
        Route::any('index', [\App\Http\Controllers\Api\User\OpportunityController::class, 'index'])->name('api.v1.user.opportunity.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\OpportunityController::class, 'datatable'])->name('api.v1.user.opportunity.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\OpportunityController::class, 'show'])->name('api.v1.user.opportunity.show')->middleware(['CheckMethod:get']);
        Route::any('save', [\App\Http\Controllers\Api\User\OpportunityController::class, 'save'])->name('api.v1.user.opportunity.save')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\OpportunityController::class, 'drop'])->name('api.v1.user.opportunity.drop')->middleware(['CheckMethod:delete']);
    });

    Route::prefix('waitingTransaction')->group(function () {
        Route::prefix('customer')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\WaitingTransaction\CustomerController::class, 'datatable'])->name('api.v1.user.waitingTransaction.customer.datatable')->middleware(['CheckMethod:get']);
            Route::any('accept', [\App\Http\Controllers\Api\User\WaitingTransaction\CustomerController::class, 'accept'])->name('api.v1.user.waitingTransaction.customer.accept')->middleware(['CheckMethod:put']);
        });

        Route::prefix('dealer')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\WaitingTransaction\DealerController::class, 'datatable'])->name('api.v1.user.waitingTransaction.dealer.datatable')->middleware(['CheckMethod:get']);
            Route::any('accept', [\App\Http\Controllers\Api\User\WaitingTransaction\DealerController::class, 'accept'])->name('api.v1.user.waitingTransaction.dealer.accept')->middleware(['CheckMethod:put']);
        });

        Route::prefix('relationService')->group(function () {
            Route::any('datatable', [\App\Http\Controllers\Api\User\WaitingTransaction\CustomerServiceController::class, 'datatable'])->name('api.v1.user.waitingTransaction.relationService.datatable')->middleware(['CheckMethod:get']);
            Route::any('accept', [\App\Http\Controllers\Api\User\WaitingTransaction\CustomerServiceController::class, 'accept'])->name('api.v1.user.waitingTransaction.relationService.accept')->middleware(['CheckMethod:put']);
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

    Route::prefix('report')->group(function () {
        Route::prefix('credit')->group(function () {
            Route::prefix('customer')->group(function () {
                Route::any('datatable', [\App\Http\Controllers\Api\User\Report\Credit\CustomerController::class, 'creditReportDatatable'])->name('api.v1.user.report.credit.customer.datatable');
                Route::any('report', [\App\Http\Controllers\Api\User\Report\Credit\CustomerController::class, 'report'])->name('api.v1.user.report.credit.customer.report');
            });
        });
    });

    Route::prefix('password')->group(function () {
        Route::any('check', [\App\Http\Controllers\Api\User\PasswordController::class, 'check'])->name('api.v1.user.password.check')->middleware(['CheckMethod:get']);
        Route::any('update', [\App\Http\Controllers\Api\User\PasswordController::class, 'update'])->name('api.v1.user.password.update')->middleware(['CheckMethod:post']);
    });

    Route::prefix('payment')->group(function () {
        Route::any('getAll', [\App\Http\Controllers\Api\User\PaymentController::class, 'getAll'])->name('api.v1.user.payment.getAll')->middleware(['CheckMethod:get']);
        Route::any('getApproved', [\App\Http\Controllers\Api\User\PaymentController::class, 'getApproved'])->name('api.v1.user.payment.getApproved')->middleware(['CheckMethod:get']);
        Route::any('getById', [\App\Http\Controllers\Api\User\PaymentController::class, 'getById'])->name('api.v1.user.payment.getById')->middleware(['CheckMethod:get']);
        Route::any('create', [\App\Http\Controllers\Api\User\PaymentController::class, 'create'])->name('api.v1.user.payment.create')->middleware(['CheckMethod:post']);
        Route::any('testJqxServerSide', [\App\Http\Controllers\Api\User\PaymentController::class, 'testJqxServerSide'])->name('api.v1.user.payment.testJqxServerSide')->middleware(['CheckMethod:get']);
    });

    Route::prefix('service')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\ServiceController::class, 'index'])->name('api.v1.user.service.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\ServiceController::class, 'datatable'])->name('api.v1.user.service.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\ServiceController::class, 'show'])->name('api.v1.user.service.show')->middleware(['CheckMethod:get']);
        Route::any('create', [\App\Http\Controllers\Api\User\ServiceController::class, 'create'])->name('api.v1.user.service.create')->middleware(['CheckMethod:post|put']);
        Route::any('update', [\App\Http\Controllers\Api\User\ServiceController::class, 'update'])->name('api.v1.user.service.update')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\ServiceController::class, 'drop'])->name('api.v1.user.service.drop')->middleware(['CheckMethod:delete|DELETE']);
    });

    Route::prefix('announcement')->group(function () {
        Route::any('index', [\App\Http\Controllers\Api\User\AnnouncementController::class, 'index'])->name('api.v1.user.announcement.index')->middleware(['CheckMethod:get']);
        Route::any('datatable', [\App\Http\Controllers\Api\User\AnnouncementController::class, 'datatable'])->name('api.v1.user.announcement.datatable')->middleware(['CheckMethod:get']);
        Route::any('show', [\App\Http\Controllers\Api\User\AnnouncementController::class, 'show'])->name('api.v1.user.announcement.show')->middleware(['CheckMethod:get']);
        Route::any('create', [\App\Http\Controllers\Api\User\AnnouncementController::class, 'create'])->name('api.v1.user.announcement.create')->middleware(['CheckMethod:post|put']);
        Route::any('update', [\App\Http\Controllers\Api\User\AnnouncementController::class, 'update'])->name('api.v1.user.announcement.update')->middleware(['CheckMethod:post|put']);
        Route::any('drop', [\App\Http\Controllers\Api\User\AnnouncementController::class, 'drop'])->name('api.v1.user.announcement.drop')->middleware(['CheckMethod:delete|DELETE']);
    });

    Route::prefix('log')->group(function () {
        Route::prefix('relationService')->group(function () {
            Route::get('index', [\App\Http\Controllers\Api\User\Log\RelationServiceController::class, 'index'])->name('api.v1.user.log.relationService.index');
        });
    });

    Route::prefix('crsService')->group(function () {
        Route::post('CreateNewCustomer', [\App\Http\Controllers\Api\User\CrsServiceController::class, 'CreateNewCustomer'])->name('api.v1.user.crsService.CreateNewCustomer');
    });

});
