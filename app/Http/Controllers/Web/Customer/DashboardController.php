<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function index()
    {
        return view('customer.pages.dashboard.index');
    }
}
