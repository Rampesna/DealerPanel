<?php

namespace App\Http\Controllers\Web\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\Customer\OAuthLoginRequest;
use App\Services\Auth\CustomerAuthService;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard.index');
        }

        return view('customer.pages.auth.login.index');
    }

    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new CustomerAuthService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('customer')->check()) Auth::guard('customer')->logout();
    }
}
