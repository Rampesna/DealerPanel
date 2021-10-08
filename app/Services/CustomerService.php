<?php

namespace App\Services;

use App\Models\Customer;
use App\Traits\Response;
use Yajra\DataTables\DataTables;

class CustomerService
{
    use Response;

    /**
     * @param Customer $customer ;
     */
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

    public function datatable(
        $dealer_id
    )
    {
        return DataTables::of(Customer::whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id)))->make(true);
    }
}
