<?php

namespace App\Http\Controllers\Api\DealerUser\Report\Credit;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Traits\Response;
use App\Http\Requests\Api\DealerUser\Report\Credit\Customer\CreditReportDatatableRequestRequest;

class CustomerController extends Controller
{
    use Response;

    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function creditReportDatatable(CreditReportDatatableRequestRequest $request)
    {
        return $this->customerService->creditReportDatatable($request->dealer_id);
    }
}
