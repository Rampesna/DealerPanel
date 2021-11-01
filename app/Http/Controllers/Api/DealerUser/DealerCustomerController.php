<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Customer\SaveRequest;
use App\Http\Requests\Api\DealerUser\Customer\ShowRequest;
use App\Services\CustomerService;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DealerCustomerController extends Controller
{
    use Response;

    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function index(Request $request)
    {
        return $this->customerService->index(2, Crypt::decrypt($request->dealer_id));
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable(null, Crypt::decrypt($request->dealer_id));
    }
}
