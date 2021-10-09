<?php

namespace App\Http\Controllers\Web\User;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\User\Auth\OAuthLoginRequest;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('user.dashboard.index');
        }

        return view('user.pages.auth.login.index');
    }

    /**
     * @param OAuthLoginRequest $request
     */
    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new UserService)->oAuthLogin($request->api_token);
    }

    public function logout()
    {
        if (Auth::guard('user')->check()) Auth::guard('user')->logout();
    }
}
