<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\Customer\LoginRequest;
use App\Services\Auth\CustomerAuthService;

class CustomerAuthenticationController extends Controller
{
    private $customerAuthService;

    public function __construct()
    {
        $this->customerAuthService = new CustomerAuthService;
    }

    public function login(LoginRequest $request)
    {
        return $this->customerAuthService->login(
            $request->tax_number,
            $request->password
        );
    }
}
