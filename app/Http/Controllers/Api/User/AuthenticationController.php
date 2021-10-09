<?php

namespace App\Http\Controllers\Api\User;

use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Auth\LoginRequest;

class AuthenticationController extends Controller
{
    private $customerService;

    public function __construct()
    {
        $this->customerService = new UserService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        return $this->customerService->login(
            $request->email,
            $request->password
        );
    }
}
