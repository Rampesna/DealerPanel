<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::guard('customer')->check()) return redirect()->route('customer.dashboard.index');
    if (\Illuminate\Support\Facades\Auth::guard('dealerUser')->check()) return redirect()->route('dealerUser.dashboard.index');
    if (\Illuminate\Support\Facades\Auth::guard('user')->check()) return redirect()->route('user.dashboard.index');

    return redirect()->route('dealerUser.login');
});

Route::get('payment/3d/gateway/{encryptedOrderId?}', [\App\Http\Controllers\Web\PaymentController::class, 'gateway'])->name('payment.gateway');
Route::post('payment/3d/create', [\App\Http\Controllers\Web\PaymentController::class, 'create'])->name('payment.create');
Route::post('payment/3d/success', [\App\Http\Controllers\Web\PaymentController::class, 'success'])->name('payment.success')->withoutMiddleware([
    'web'
]);
Route::get('payment/3d/success/result', [\App\Http\Controllers\Web\PaymentController::class, 'successWeb'])->name('payment.success.web');
Route::post('payment/3d/failure', [\App\Http\Controllers\Web\PaymentController::class, 'failure'])->name('payment.failure');
Route::get('payment/3d/failure/result', [\App\Http\Controllers\Web\PaymentController::class, 'failureWeb'])->name('payment.failure.web');

Route::get('customerCreditReport', function () {
    set_time_limit(86400);
    return Excel::download(new \App\Exports\CustomerCreditUsageExport, 'Müşteri Kontör Raporu.xls');
})->name('customer.credit.report.export');


Route::get('testUyumsoftSoap', function () {
    $uyumsoftSoapService = new \App\SoapServices\UyumsoftSoapService;
    return $uyumsoftSoapService->GetInboxDespatch();
});
