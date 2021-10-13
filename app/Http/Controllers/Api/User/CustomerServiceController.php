<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\DatatableRequest;
use App\Http\Requests\Api\User\CustomerService\IndexRequest;
use App\Http\Requests\Api\User\CustomerService\ShowRequest;
use App\Http\Requests\Api\User\CustomerService\SaveRequest;
use App\Http\Requests\Api\User\CustomerService\DropRequest;
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

    /**
     * @param ShowRequest $request
     */
    public function show(ShowRequest $request)
    {
        return $this->customerServiceService->show($request->id);
    }

    /**
     * @param SaveRequest $request
     */
    public function save(SaveRequest $request)
    {
        return $this->customerServiceService->save(
            $request->id,
            gettype($request->customer_id) == 'integer' ? $request->customer_id : Crypt::decrypt($request->customer_id),
            $request->service_id,
            $request->start,
            $request->end,
            $request->amount,
            $request->status_id
        );
    }

    /**
     * @param DropRequest $request
     */
    public function drop(DropRequest $request)
    {
        return $this->customerServiceService->drop($request->id);
    }
}
