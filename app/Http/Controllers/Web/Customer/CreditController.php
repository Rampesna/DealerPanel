<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;


class CreditController extends Controller
{
    public function index()
    {
        return view('customer.pages.credit.index');
    }
}
