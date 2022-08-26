<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\BienSoap\UsageReportRequest;
use App\SoapServices\BienSoapService;

class BienSoapController extends Controller
{
    private $bienSoapService;

    public function __construct()
    {
        $this->bienSoapService = new BienSoapService;
    }

    public function usageReport(UsageReportRequest $request)
    {
        return $this->bienSoapService->GetCustomerReportWithSoftware(
            $request->start_date,
            $request->end_date,
            $request->tax_number
        );
    }
}
