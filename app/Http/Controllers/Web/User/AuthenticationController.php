<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\User\OAuthLoginRequest;
use App\Services\Auth\UserAuthService;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard.index');
        }

        return view('user.pages.auth.login.index');
    }

    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new UserAuthService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) Auth::guard('user')->logout();
    }
}
