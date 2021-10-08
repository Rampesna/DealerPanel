<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dealer.pages.dashboard.index');
    }
}
