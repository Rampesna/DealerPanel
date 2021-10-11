<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\SupportRequestPriority\IndexRequest;
use App\Services\SupportRequestPriorityService;

class SupportRequestPriorityController extends Controller
{
    private $supportRequestPriorityService;

    public function __construct()
    {
        $this->supportRequestPriorityService = new SupportRequestPriorityService;
    }

    public function index(IndexRequest $request)
    {
        return $this->supportRequestPriorityService->index();
    }
}
