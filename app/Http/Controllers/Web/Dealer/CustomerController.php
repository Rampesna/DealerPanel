<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return view('dealer.pages.customer.index.index');
    }
}
