<?php

namespace App\Http\Controllers\Api\Customer;

use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    private $customerAuthService;

    public function __construct()
    {
        $this->customerAuthService = new CustomerService;
    }

    public function login(LoginRequest $request)
    {
        return $this->customerAuthService->login(
            $request->tax_number,
            $request->password
        );
    }
}
