<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\BienSoap\UsageReportRequest;
use App\Http\Requests\Api\DealerUser\BienSoap\UsageReportByCustomerIdRequest;
use App\Http\Requests\Api\DealerUser\BienSoap\UsageListByCustomerIdRequest;
use App\Models\Customer;
use App\SoapServices\BienSoapService;
use Illuminate\Support\Facades\Crypt;
use App\Traits\Response;

class BienSoapController extends Controller
{
    use Response;

    private $bienSoapService;

    public function __construct()
    {
        $this->bienSoapService = new BienSoapService;
    }

    public function usageReport(UsageReportRequest $request)
    {
        $response = $this->bienSoapService->GetCustomerReportWithSoftware(
            $request->start_date,
            $request->end_date,
            $request->tax_number
        );

        $usage = 0;

        if (is_array($response->GetCustomerReportWithSoftwareResult->Value->Usages)) {
            foreach ($response->GetCustomerReportWithSoftwareResult->Value->Usages as $usageItem) {
                $usage += $usageItem->Items->Count;
            }
        } else {
            $usage = $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count;
        }

        return $this->success('Usage report', $usage);
    }

    public function usageReportByCustomerId(UsageReportByCustomerIdRequest $request)
    {
        $customer = Customer::find(Crypt::decrypt($request->customer_id));
        $response = $this->bienSoapService->GetCustomerReportWithSoftware(
            $request->start_date,
            $request->end_date,
            $customer->tax_number
        );

        $usage = 0;

        if (is_array($response->GetCustomerReportWithSoftwareResult->Value->Usages)) {
            foreach ($response->GetCustomerReportWithSoftwareResult->Value->Usages as $usageItem) {
                $usage += $usageItem->Items->Count;
            }
        } else {
            $usage = $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count;
        }

        return $this->success('Usage report', $usage);
    }

    public function usageListByCustomerId(UsageListByCustomerIdRequest $request)
    {
        $customer = Customer::find(Crypt::decrypt($request->customer_id));
        $response = $this->bienSoapService->GetCustomerReportWithSoftware(
            $request->start_date,
            $request->end_date,
            $customer->tax_number
        );

        return $this->success('Usage report', $response->GetCustomerReportWithSoftwareResult->Value);
    }
}
