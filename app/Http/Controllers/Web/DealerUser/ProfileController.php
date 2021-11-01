<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function index()
    {
        return view('dealerUser.pages.profile.index');
    }
}
