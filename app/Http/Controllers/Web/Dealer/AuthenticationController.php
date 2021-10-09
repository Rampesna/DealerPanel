<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Services\DealerService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Dealer\Auth\OAuthLoginRequest;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::guard('dealer')->check()) {
            return redirect()->route('dealer.dashboard.index');
        }

        return view('dealer.pages.auth.login.index');
    }

    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new DealerService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('dealer')->check()) Auth::guard('dealer')->logout();
    }
}
