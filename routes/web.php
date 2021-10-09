<?php

use App\Models\Customer;
use App\Services\DealerService;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $customers = Customer::with([]);

    $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds(4));

    return $customers->get();
});
