<?php

namespace App\Http\Controllers\Api\Customer;

use App\Services\CustomerService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        return $this->customerService->login(
            $request->tax_number,
            $request->password
        );
    }
}
