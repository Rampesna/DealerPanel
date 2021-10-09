<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.dashboard.index');
    }
}
