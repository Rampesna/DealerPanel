<?php

namespace App\Http\Controllers\Web\DealerUser;

use App\Services\DealerUserService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\DealerUser\Auth\OAuthLoginRequest;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::guard('dealerUser')->check()) {
            return redirect()->route('dealerUser.dashboard.index');
        }

        return view('dealerUser.pages.auth.login.index');
    }

    /**
     * @param OAuthLoginRequest $request
     */
    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new DealerUserService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('dealerUser')->check()) Auth::guard('dealerUser')->logout();
    }
}
