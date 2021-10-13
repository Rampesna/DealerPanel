<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\SupportRequest\DatatableRequest;
use App\Http\Requests\Api\User\SupportRequest\IndexRequest;
use App\Http\Requests\Api\User\SupportRequest\ShowRequest;
use App\Http\Requests\Api\User\SupportRequest\UpdateStatusRequest;
use App\Services\SupportRequestService;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class SupportRequestController extends Controller
{
    use Response;

    private $supportRequestService;

    public function __construct()
    {
        $this->supportRequestService = new SupportRequestService;
    }

    public function index(IndexRequest $request)
    {
        return $this->supportRequestService->index(
            $request->creator_type,
            $request->creator_id
        );
    }

    public function datatable(DatatableRequest $request)
    {
        return $this->supportRequestService->datatable(
            $request->creator_type,
            $request->creator_id ?
                gettype($request->creator_id) == 'integer' ?
                    $request->creator_id : Crypt::decrypt($request->creator_id) : null
        );
    }

    public function show(ShowRequest $request)
    {
        return $this->supportRequestService->show($request->id);
    }

    public function updateStatus(UpdateStatusRequest $request)
    {
        return $this->supportRequestService->updateStatus(
            $request->id,
            $request->status_id
        );
    }
}
