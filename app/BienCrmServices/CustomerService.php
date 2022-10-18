<?php

namespace App\BienCrmServices;

use App\Models\Customer;

class CustomerService extends BienCrmService
{
    public function create(
        Customer $customer
    )
    {
        $endpoint = 'customer/create';
        return $this->client->post($this->baseUrl . $endpoint, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'form_params' => [
                'name' => $customer->name,
                'email' => $customer->email,
                'identificationNumber' => $customer->tax_number,
                'phoneNumber' => $customer->gsm,
                'countryId' => $customer->country_id,
                'provinceId' => $customer->province_id,
                'districtId' => $customer->district_id,
                'foundationDate' => $customer->foundation_date,
                'website' => $customer->website,
                'dealerId' => $customer->dealer_id,
            ],
        ])->getBody()->getContents();
    }
}
