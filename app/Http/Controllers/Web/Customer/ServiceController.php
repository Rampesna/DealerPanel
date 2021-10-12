<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;


class ServiceController extends Controller
{
    public function index()
    {
        return view('customer.pages.service.index');
    }
}
