<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\SupportRequest\DatatableRequest;
use App\Http\Requests\Api\DealerUser\SupportRequest\IndexRequest;
use App\Http\Requests\Api\DealerUser\SupportRequest\SaveRequest;
use App\Http\Requests\Api\DealerUser\SupportRequest\ShowRequest;
use App\Services\SupportRequestService;
use App\Traits\Response;

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
            $request->creator_id
        );
    }

    public function show(ShowRequest $request)
    {
        return $this->supportRequestService->show($request->id);
    }

    public function save(SaveRequest $request)
    {
        return $this->supportRequestService->save(
            $request->id,
            $request->creator_type,
            $request->creator_id,
            $request->name,
            $request->description,
            $request->category_id,
            $request->priority_id,
            $request->status_id
        );
    }
}
