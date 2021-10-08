<?php

namespace App\Services\Auth;

use App\Models\Customer;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthService
{
    use Response;

    private $customer;

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function login(
        $tax_number,
        $password
    )
    {
        $customer = Customer::where('tax_number', $tax_number)->first();

        if (!$customer) {
            return $this->error('Customer not found', 404);
        }

        if (!Hash::check($password, $customer->password)) {
            return $this->error('Credentials not correct', 400);
        }

        if (!$customer->api_token) {
            $customer->api_token = generateToken();
            $customer->save();
        }

        return $this->success('Customer logged in successfully', $customer);
    }

    public function oAuthLogin(
        $api_token
    )
    {
        $customer = Customer::where('api_token', $api_token)->first();

        if (!$customer) {
            return $this->error('Token not correct!');
        }

        Auth::guard('customer')->login($customer);

        return $this->success('Customer logged in successfully with oAuth', $customer);
    }
}
