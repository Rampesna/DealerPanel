<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.finance.index');
    }
}
