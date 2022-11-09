<?php

namespace App\Http\Controllers\Api\User\Report\Credit;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\CustomerService;
use App\SoapServices\BienSoapService;
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
        set_time_limit(86400);
        return $this->customerService->creditReportDatatable();
    }

    public function report()
    {
        set_time_limit(86400);
        $bienSoapService = new BienSoapService;
        $usages = collect($bienSoapService->GetCustomerReportWithSoftware(
            '2000-01-01',
            '2050-01-01'
        )->GetCustomerReportWithSoftwareResult->Value);
        $customers = Customer::with([
            'credits',
            'dealer',
        ])->get();

        foreach ($customers as $customer) {
            $customerFromService = $usages->where('VknTckn', $customer->tax_number)->first();
            if ($customerFromService && $customerFromService->Usages) {

                $customerUsage = 0;

                if (is_array($customerFromService->Usages)) {
                    foreach ($customerFromService->Usages as $usageItem) {
                        if ($usageItem->Type == 'Ledger') {
                            $customerUsage += $usageItem->Items->Count / 1000;
                        } else if ($usageItem->Type == 'OutboxEArchive') {
                            $customerUsage += $usageItem->Items->Count / $customer->divisor;
                        } else if ($usageItem->Type == 'Ticket') {
                            $customerUsage += $usageItem->Items->Count / 5;
                        } else {
                            $customerUsage += $usageItem->Items->Count;
                        }
                    }
                } else {
                    if ($customerFromService->Usages->Type == 'Ledger') {
                        $customerUsage += $customerFromService->Usages->Items->Count / 1000;
                    } else if ($customerFromService->Usages->Type == 'OutboxEArchive') {
                        $customerUsage += $customerFromService->Usages->Items->Count / $customer->divisor;
                    } else if ($customerFromService->Usages->Type == 'Ticket') {
                        $customerUsage += $customerFromService->Usages->Items->Count / 5;
                    } else {
                        $customerUsage += $customerFromService->Usages->Items->Count;
                    }
                }

                $response[] = [
                    'taxNumber' => $customer->tax_number,
                    'name' => $customer->name,
                    'dealer' => $customer->dealer ? $customer->dealer->name : '',
                    'bought' => $customer->credits->where('direction', 1)->sum('amount'),
                    'used' => $customerUsage + $customer->credits->where('direction', 0)->sum('amount'),
                    'remaining' => $customer->credits->where('direction', 1)->sum('amount') - ($customerUsage + $customer->credits->where('direction', 0)->sum('amount'))
                ];
            } else {
                $response[] = [
                    'taxNumber' => $customer->tax_number,
                    'name' => $customer->name,
                    'dealer' => $customer->dealer ? $customer->dealer->name : '',
                    'bought' => $customer->credits->where('direction', 1)->sum('amount'),
                    'used' => $customer->credits->where('direction', 0)->sum('amount'),
                    'remaining' => $customer->credits->where('direction', 1)->sum('amount') - $customer->credits->where('direction', 0)->sum('amount')
                ];
            }
        }

        return response()->json(collect($response));
    }
}
