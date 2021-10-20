<?php

namespace App\Http\Controllers\Web\Customer;

use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Customer\Auth\OAuthLoginRequest;
use App\Http\Requests\Web\Customer\Auth\OAuthLoginWithTaxNumberRequest;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard.index');
        }

        return view('customer.pages.auth.login.index');
    }

    /**
     * @param OAuthLoginRequest $request
     */
    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new CustomerService)->oAuthLogin($request->api_token);
    }

    /**
     * @param OAuthLoginWithTaxNumberRequest $request
     */
    public function oAuthLoginWithTaxNumber(OAuthLoginWithTaxNumberRequest $request)
    {
        return (new CustomerService)->oAuthLoginWithTaxNumber(base64_decode($request->encrypted_tax_number));
    }

    public function logout()
    {
        if (Auth::guard('customer')->check()) Auth::guard('customer')->logout();
    }
}
