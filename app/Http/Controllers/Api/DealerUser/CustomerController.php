<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Customer\SaveRequest;
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

    public function index(Request $request)
    {
        return $this->customerService->index($request->dealerUser->dealer_id);
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable($request->dealerUser->dealer_id);
    }

    public function save(SaveRequest $request)
    {
        return $request;
    }
}
