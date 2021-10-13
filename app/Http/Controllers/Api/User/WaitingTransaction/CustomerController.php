<?php

namespace App\Http\Controllers\Api\User\WaitingTransaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Customer\AcceptRequest;
use App\Services\CustomerService;
use App\Traits\Response;

class CustomerController extends Controller
{
    use Response;

    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function datatable()
    {
        return $this->customerService->datatable(1);
    }

    public function accept(AcceptRequest $request)
    {
        $this->customerService->updateTransactionStatus(
            $request->customer_id,
            $request->transaction_status_id
        );
    }
}
