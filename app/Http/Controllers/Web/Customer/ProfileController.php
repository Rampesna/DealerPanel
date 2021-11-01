<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function index()
    {
        return view('customer.pages.profile.index');
    }
}
