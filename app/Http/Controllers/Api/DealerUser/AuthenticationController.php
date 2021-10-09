<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Services\DealerUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    private $dealerUserService;

    public function __construct()
    {
        $this->dealerUserService = new DealerUserService;
    }

    public function login(LoginRequest $request)
    {
        return $this->dealerUserService->login(
            $request->email,
            $request->password
        );
    }
}
