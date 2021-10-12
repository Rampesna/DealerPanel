<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;


class FinanceController extends Controller
{
    public function index()
    {
        return view('customer.pages.finance.index');
    }
}
