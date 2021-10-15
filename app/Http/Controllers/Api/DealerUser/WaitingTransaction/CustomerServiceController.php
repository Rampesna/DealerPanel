<?php

namespace App\Http\Controllers\Api\DealerUser\WaitingTransaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\CustomerService\AcceptRequest;
use App\Services\RelationServiceService;
use App\Traits\Response;
use Illuminate\Http\Request;

class CustomerServiceController extends Controller
{
    use Response;

    private $relationServiceService;

    public function __construct()
    {
        $this->relationServiceService = new RelationServiceService;
    }

    public function datatable(Request $request)
    {
        return $this->relationServiceService->datatable(
            $request->relation_type,
            $request->relation_id,
            $request->transaction_status_id
        );
    }

    public function accept(AcceptRequest $request)
    {
        return $this->relationServiceService->updateTransactionStatus(
            $request->customer_service_id,
            $request->transaction_status_id
        );
    }
}
