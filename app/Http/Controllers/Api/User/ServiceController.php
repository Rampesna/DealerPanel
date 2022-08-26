<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Service\DropRequest;
use App\Http\Requests\Api\User\Service\CreateRequest;
use App\Http\Requests\Api\User\Service\UpdateRequest;
use App\Http\Requests\Api\User\Service\ShowRequest;
use App\Services\ServiceService;
use App\Services\UserService;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class ServiceController extends Controller
{
    use Response;

    private $serviceService;

    public function __construct()
    {
        $this->serviceService = new ServiceService;
    }

    public function index()
    {
        return $this->serviceService->index();
    }

    public function datatable()
    {
        return $this->serviceService->datatable();
    }

    public function show(ShowRequest $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $exception) {
            $id = $request->id;
        }
        return $this->serviceService->show($id);
    }

    public function create(CreateRequest $request)
    {
        return $this->serviceService->create(
            $request->name,
            $request->credit_amount,
            $request->price
        );
    }

    public function update(UpdateRequest $request)
    {
        return $this->serviceService->update(
            $request->id,
            $request->name,
            $request->credit_amount,
            $request->price
        );
    }

    public function drop(DropRequest $request)
    {
        $this->serviceService->drop($request->id);
    }
}
