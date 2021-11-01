<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Password\CheckPasswordRequest;
use App\Http\Requests\Api\DealerUser\Password\UpdatePasswordRequest;
use App\Services\DealerUserService;


class PasswordController extends Controller
{
    private $dealerUserService;

    public function __construct()
    {
        $this->dealerUserService = new DealerUserService;
    }

    public function check(CheckPasswordRequest $request)
    {
        return $this->dealerUserService->checkPassword($request->dealer_user_id, $request->password);
    }

    public function update(UpdatePasswordRequest $request)
    {
        return $this->dealerUserService->updatePassword($request->dealer_user_id, bcrypt($request->password));
    }
}
