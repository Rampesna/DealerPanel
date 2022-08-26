<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\User\DropRequest;
use App\Http\Requests\Api\User\User\SaveRequest;
use App\Http\Requests\Api\User\User\ShowRequest;
use App\Services\UserService;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    use Response;

    private $userService;

    public function __construct()
    {
        $this->userService = new UserService;
    }

    public function index()
    {
        return $this->userService->index();
    }

    public function datatable()
    {
        return $this->userService->datatable();
    }

    public function show(ShowRequest $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $exception) {
            $id = $request->id;
        }
        return $this->userService->show($id);
    }

    public function save(SaveRequest $request)
    {
        return $this->userService->save(
            $request->id,
            $request->name,
            $request->email,
            $request->password ? bcrypt($request->password) : null
        );
    }

    public function drop(DropRequest $request)
    {
        $this->userService->drop($request->id);
    }
}
