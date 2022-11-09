<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\BienSoap\UsageReportRequest;
use App\Http\Requests\Api\User\BienSoap\UsageReportByCustomerIdRequest;
use App\Http\Requests\Api\User\BienSoap\UsageListByCustomerIdRequest;
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

        $customer = Customer::where('tax_number', $request->tax_number)->first();

        $usage = 0;

        if (is_array($response->GetCustomerReportWithSoftwareResult->Value->Usages)) {
            foreach ($response->GetCustomerReportWithSoftwareResult->Value->Usages as $usageItem) {
                if ($usageItem->Type == 'Ledger') {
                    $usage += $usageItem->Items->Count / 1000;
                } else if ($usageItem->Type == 'OutboxEArchive') {
                    $usage += $usageItem->Items->Count / $customer->divisor;
                } else if ($usageItem->Type == 'Ticket') {
                    $usage += $usageItem->Items->Count / 5;
                } else {
                    $usage += $usageItem->Items->Count;
                }
            }
        } else {
            if ($response->GetCustomerReportWithSoftwareResult->Value->Usages->Type == 'Ledger') {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count / 1000;
            } else if ($response->GetCustomerReportWithSoftwareResult->Value->Usages->Type == 'OutboxEArchive') {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count / $customer->divisor;
            } else if ($response->GetCustomerReportWithSoftwareResult->Value->Usages->Type == 'Ticket') {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count / 5;
            } else {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count;
            }
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
                if ($usageItem->Type == 'Ledger') {
                    $usage += $usageItem->Items->Count / 1000;
                } else if ($usageItem->Type == 'OutboxEArchive') {
                    $usage += $usageItem->Items->Count / $customer->divisor;
                } else if ($usageItem->Type == 'Ticket') {
                    $usage += $usageItem->Items->Count / 5;
                } else {
                    $usage += $usageItem->Items->Count;
                }
            }
        } else {
            if ($response->GetCustomerReportWithSoftwareResult->Value->Usages->Type == 'Ledger') {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count / 1000;
            } else if ($response->GetCustomerReportWithSoftwareResult->Value->Usages->Type == 'OutboxEArchive') {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count / $customer->divisor;
            } else if ($response->GetCustomerReportWithSoftwareResult->Value->Usages->Type == 'Ticket') {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count / 5;
            } else {
                $usage += $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count;
            }
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

        return $this->success('Usage report', [
            'usages' => $response->GetCustomerReportWithSoftwareResult->Value->Usages,
            'customer' => $customer
        ]);
    }
}
