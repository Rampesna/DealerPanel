<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\CustomerService\DatatableRequest;
use App\Http\Requests\Api\DealerUser\CustomerService\IndexRequest;
use App\Services\CustomerServiceService;
use Illuminate\Support\Facades\Crypt;

class CustomerServiceController extends Controller
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
        return $this->customerServiceService->index(Crypt::decrypt($request->customer_id), null, 2);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->customerServiceService->datatable(Crypt::decrypt($request->customer_id), null, 2);
    }
}
