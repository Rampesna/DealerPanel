<?php

namespace App\Http\Controllers\Api\Dealer;

use App\Services\DealerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Dealer\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    private $dealerAuthService;

    public function __construct()
    {
        $this->dealerAuthService = new DealerService;
    }

    public function login(LoginRequest $request)
    {
        return $this->dealerAuthService->login(
            $request->tax_number,
            $request->password
        );
    }
}
