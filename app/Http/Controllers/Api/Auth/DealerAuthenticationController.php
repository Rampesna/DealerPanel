<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\Dealer\LoginRequest;
use App\Services\Auth\DealerAuthService;

class DealerAuthenticationController extends Controller
{
    private $dealerAuthService;

    public function __construct()
    {
        $this->dealerAuthService = new DealerAuthService;
    }

    public function login(LoginRequest $request)
    {
        return $this->dealerAuthService->login(
            $request->tax_number,
            $request->password
        );
    }
}
