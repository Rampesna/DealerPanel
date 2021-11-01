<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::guard('customer')->check()) return redirect()->route('customer.dashboard.index');
    if (\Illuminate\Support\Facades\Auth::guard('dealerUser')->check()) return redirect()->route('dealerUser.dashboard.index');
    if (\Illuminate\Support\Facades\Auth::guard('user')->check()) return redirect()->route('user.dashboard.index');

    return redirect()->route('dealerUser.login');
});

Route::get('/test', function () {
    $jsonData = file_get_contents(public_path('data.json'));
    $collection = collect(json_decode($jsonData));
    $array = [];

    foreach ($collection as $data) {

        $customer = \App\Models\Customer::where('tax_number', $data->tax_number)->first();

        if ($customer) {
            $array[] = [
                'relation_type' => 'App\\Models\\Customer',
                'relation_id' => $customer->id,
                'relation_service_id' => null,
                'amount' => $data->amount,
                'direction' => 1,
                'created_at' => date('Y-m-d'),
                'updated_at' => date('Y-m-d')
            ];
        }
    }

});
