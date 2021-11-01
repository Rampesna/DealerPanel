<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\CustomerService\DatatableRequest;
use App\Http\Requests\Api\Customer\CustomerService\IndexRequest;
use App\Services\RelationServiceService;

class ServiceController extends Controller
{
    private $relationServiceService;

    public function __construct()
    {
        $this->relationServiceService = new RelationServiceService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        return $this->relationServiceService->index($request->customer->id, null, 2);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->relationServiceService->datatable($request->customer_id, null, 2);
    }
}
