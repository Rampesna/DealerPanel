<?php

namespace App\Http\Controllers\Api\User\WaitingTransaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Dealer\AcceptRequest;
use App\Services\DealerService;
use App\Traits\Response;

class DealerController extends Controller
{
    use Response;

    private $dealerService;

    public function __construct()
    {
        $this->dealerService = new DealerService;
    }

    public function datatable()
    {
        return $this->dealerService->datatable(null, 1);
    }

    public function accept(AcceptRequest $request)
    {
        $this->dealerService->updateTransactionStatus(
            $request->dealer_id,
            $request->transaction_status_id
        );
    }
}
