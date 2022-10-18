<?php

namespace App\Exports;

use App\Models\Customer;
use App\SoapServices\BienSoapService;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerCreditUsageExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $response = [
            [
                'taxNumber' => 'VKN/TCKN',
                'name' => 'Müşteri',
                'dealer' => 'Bayi',
                'bought' => 'Alınan Kontör',
                'used' => 'Kullanılan Kontör',
                'remaining' => 'Kalan Kontör',
            ]
        ];

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
                foreach ($customerFromService->Usages as $customerUsageItem) {
                    if (isset($customerUsageItem->Items)) {
                        $customerUsage += $customerUsageItem->Items->Count;
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

        return collect($response);
    }
}
