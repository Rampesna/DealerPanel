<?php

namespace App\Http\Controllers\Api\User;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    private $userAuthService;

    public function __construct()
    {
        $this->userAuthService = new UserService;
    }

    public function login(LoginRequest $request)
    {
        return $this->userAuthService->login(
            $request->email,
            $request->password
        );
    }
}
