<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;


class CreditController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.credit.index');
    }
}
