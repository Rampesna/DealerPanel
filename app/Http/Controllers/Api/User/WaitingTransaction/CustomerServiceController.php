<?php

namespace App\Http\Controllers\Api\User\WaitingTransaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\AcceptRequest;
use App\Services\RelationServiceService;
use App\Traits\Response;

class CustomerServiceController extends Controller
{
    use Response;

    private $relationServiceService;

    public function __construct()
    {
        $this->relationServiceService = new RelationServiceService;
    }

    public function datatable()
    {
        return $this->relationServiceService->datatable(null, null, 1);
    }

    public function accept(AcceptRequest $request)
    {
        return $this->relationServiceService->updateTransactionStatus(
            $request->customer_service_id,
            $request->transaction_status_id
        );
    }
}
