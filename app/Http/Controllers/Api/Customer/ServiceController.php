<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\CustomerService\DatatableRequest;
use App\Http\Requests\Api\Customer\CustomerService\IndexRequest;
use App\Services\CustomerServiceService;

class ServiceController extends Controller
{
    private $customerServiceService;

    public function __construct()
    {
        $this->customerServiceService = new CustomerServiceService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        return $this->customerServiceService->index($request->customer->id, null, 2);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->customerServiceService->datatable($request->customer->id, null, 2);
    }
}
