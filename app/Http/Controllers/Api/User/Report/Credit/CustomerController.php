<?php

namespace App\Http\Controllers\Api\User\Report\Credit;

use App\Http\Controllers\Controller;
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

    public function creditReportDatatable()
    {
        return $this->customerService->creditReportDatatable();
    }
}
