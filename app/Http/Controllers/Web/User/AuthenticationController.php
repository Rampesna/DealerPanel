<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\User\OAuthLoginRequest;
use App\Services\Auth\UserAuthService;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('user.pages.auth.login.index');
    }

    public function oAuthLogin(OAuthLoginRequest $request)
    {
        return (new UserAuthService)->oAuthLogin($request->api_token);
    }
}
