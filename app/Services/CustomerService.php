<?php

namespace App\Services;

use App\Models\Customer;
use App\Traits\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class CustomerService
{
    use Response;

    /**
     * @param string $tax_number
     * @param string $password
     */
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

    /**
     * @param string $api_token
     */
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

    /**
     * @param int $dealer_id default null
     */
    public function index(
        $dealer_id = null
    )
    {
        $customers = Customer::with([]);

        if ($dealer_id) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        return $this->success('All customers', $customers->get());
    }

    /**
     * @param int $dealer_id default null
     */
    public function datatable(
        $dealer_id = null
    )
    {
        $customers = Customer::with([]);

        if ($dealer_id) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        return DataTables::of($customers)->make(true);
    }

    /**
     * @param int $id
     * @param int $dealer_id
     * @param string $tax_number
     * @param string $name
     * @param string $password
     */
    public function save(
        int    $id,
        int    $dealer_id,
        string $tax_number,
        string $name,
        string $password
    )
    {
        $customer = $id ? Customer::find($id) : new Customer;
        $customer->dealer_id = $dealer_id;
        $customer->tax_number = $tax_number;
        $customer->name = $name;
        $customer->password = $password ?? $customer->password;
        $customer->save();

        return $customer;
    }
}
