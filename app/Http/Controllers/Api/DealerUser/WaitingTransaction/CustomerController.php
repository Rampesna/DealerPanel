<?php

namespace App\Http\Controllers\Api\DealerUser\WaitingTransaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Customer\SaveRequest;
use App\Http\Requests\Api\DealerUser\Customer\ShowRequest;
use App\Services\CustomerService;
use App\Traits\Response;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use Response;

    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable(1, $request->dealerUser->dealer_id);
    }
}
