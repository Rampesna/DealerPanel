<?php

namespace App\Services\Auth;

use App\Models\Customer;

class CustomerAuthService
{
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

    }
}
