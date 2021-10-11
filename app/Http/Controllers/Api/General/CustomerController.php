<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\Customer\CheckTaxNumberRequest;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function checkTaxNumber(CheckTaxNumberRequest $request)
    {
        return $this->customerService->checkTaxNumber($request->tax_number);
    }
}
