<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\CustomerServiceStatus\IndexRequest;
use App\Services\CustomerServiceStatusService;

class CustomerServiceStatusController extends Controller
{
    private $customerServiceStatusService;

    public function __construct()
    {
        $this->customerServiceStatusService = new CustomerServiceStatusService;
    }

    public function index(IndexRequest $request)
    {
        return $this->customerServiceStatusService->index();
    }
}
