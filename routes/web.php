<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::guard('customer')->check()) return redirect()->route('customer.dashboard.index');
    if (\Illuminate\Support\Facades\Auth::guard('dealerUser')->check()) return redirect()->route('dealerUser.dashboard.index');
    if (\Illuminate\Support\Facades\Auth::guard('user')->check()) return redirect()->route('user.dashboard.index');

    return redirect()->route('dealerUser.login');
});

Route::get('/test', function () {
    $list = collect(json_decode(file_get_contents(public_path('newlist.json'))));
    $array = [];
    foreach ($list as $item) {
        $customer = \App\Models\Customer::where('tax_number', $item->tax_number)->first();

        if ($customer) {
            $array[] = [
                'relation_type' => 'App\\Models\\Customer',
                'relation_id' => $customer->id,
                'amount' => doubleval($item->amount),
                'direction' => 1,
                'description' => $item->description,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
    }

    return $array;

});
