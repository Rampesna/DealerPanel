<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Password\CheckPasswordRequest;
use App\Http\Requests\Api\User\Password\UpdatePasswordRequest;
use App\Services\UserService;


class PasswordController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function check(CheckPasswordRequest $request)
    {
        return $this->userService->checkPassword($request->user_id, $request->password);
    }

    public function update(UpdatePasswordRequest $request)
    {
        return $this->userService->updatePassword($request->user_id, bcrypt($request->password));
    }
}
