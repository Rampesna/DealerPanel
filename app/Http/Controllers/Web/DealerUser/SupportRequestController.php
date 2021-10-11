<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;

class SupportRequestController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.supportRequest.index.index');
    }

    public function show()
    {
        return view('dealerUser.pages.supportRequest.show.index');
    }
}
