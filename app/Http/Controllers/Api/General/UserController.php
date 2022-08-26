<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\User\CheckEmailRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function checkEmail(CheckEmailRequest $request)
    {
        return $this->userService->checkEmail($request->email, $request->except_id);
    }
}
