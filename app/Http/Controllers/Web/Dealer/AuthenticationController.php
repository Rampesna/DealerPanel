<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('dealer.pages.auth.login.index');
    }
}
