<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\SupportRequestStatus\IndexRequest;
use App\Services\SupportRequestStatusService;

class SupportRequestStatusController extends Controller
{
    private $supportRequestStatusService;

    public function __construct()
    {
        $this->supportRequestStatusService = new SupportRequestStatusService;
    }

    public function index(IndexRequest $request)
    {
        return $this->supportRequestStatusService->index();
    }
}
