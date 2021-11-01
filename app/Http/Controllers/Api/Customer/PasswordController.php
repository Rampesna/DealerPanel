<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Password\CheckPasswordRequest;
use App\Http\Requests\Api\Customer\Password\UpdatePasswordRequest;
use App\Services\CustomerService;


class PasswordController extends Controller
{
    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function check(CheckPasswordRequest $request)
    {
        return $this->customerService->checkPassword($request->customer_id, $request->password);
    }

    public function update(UpdatePasswordRequest $request)
    {
        return $this->customerService->updatePassword($request->customer_id, bcrypt($request->password));
    }
}
