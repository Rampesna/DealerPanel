<?php

namespace App\Http\Controllers\Web\Customer;

use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Customer\Auth\OAuthLoginRequest;

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
        return (new CustomerService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('customer')->check()) Auth::guard('customer')->logout();
    }
}
