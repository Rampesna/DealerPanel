<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\User\LoginRequest;
use App\Services\Auth\UserAuthService;
use Illuminate\Http\Request;

class UserAuthenticationController extends Controller
{
    private $userAuthService;

    public function __construct()
    {
        $this->userAuthService = new UserAuthService;
    }

    public function login(LoginRequest $request)
    {
        return $this->userAuthService->login(
            $request->email,
            $request->password
        );
    }
}
