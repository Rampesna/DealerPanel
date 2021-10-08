<?php

namespace App\Http\Controllers\Web\Dealer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\Dealer\OAuthLoginRequest;
use App\Services\Auth\DealerAuthService;
use Illuminate\Support\Facades\Auth;

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
        return (new DealerAuthService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('dealer')->check()) Auth::guard('dealer')->logout();
    }
}
