<?php

namespace App\Http\Controllers\Api\User\WaitingTransaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\AcceptRequest;
use App\Services\CustomerServiceService;
use App\Traits\Response;

class CustomerServiceController extends Controller
{
    use Response;

    private $customerServiceService;

    public function __construct()
    {
        $this->customerServiceService = new CustomerServiceService;
    }

    public function datatable()
    {
        return $this->customerServiceService->datatable(null, null, 1);
    }

    public function accept(AcceptRequest $request)
    {
        $this->customerServiceService->updateTransactionStatus(
            $request->customer_service_id,
            $request->transaction_status_id
        );
    }
}
