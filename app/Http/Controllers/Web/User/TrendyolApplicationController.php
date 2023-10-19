<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;

class TrendyolApplicationController extends Controller
{
    public function index()
    {
        return view('user.pages.trendyolApplication.index.index');
    }
}
