<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Dealer;
use App\Models\TransactionStatus;
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
     * @param int|null $transaction_status_id
     * @param int|null $dealer_id
     */
    public function index(
        $transaction_status_id = null,
        $dealer_id = null
    )
    {
        $customers = Customer::with([]);

        if ($transaction_status_id) {
            $customers->where('transaction_status_id', $transaction_status_id);
        }

        if ($dealer_id) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        return $this->success('All customers', $customers->get());
    }

    /**
     * @param int|null $transaction_status_id
     * @param int|null $dealer_id
     */
    public function datatable(
        $transaction_status_id = null,
        $dealer_id = null
    )
    {
        $customers = Customer::with([]);

        if ($transaction_status_id) {
            $customers->where('transaction_status_id', $transaction_status_id);
        }

        if ($dealer_id) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        return DataTables::of($customers)->
        filterColumn('dealer_id', function ($customers, $data) {
            return $customers->whereIn('dealer_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('transaction_status', function ($customers, $data) {
            return $customers->whereIn('transaction_status_id', TransactionStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('dealer_id', function ($customer) {
            return $customer->dealer ? $customer->dealer->name : '';
        })->
        addColumn('transaction_status', function ($customer) {
            return $customer->transactionStatus ? $customer->transactionStatus->name : '';
        })->
        make(true);
    }

    /**
     * @param int $id
     */
    public function show(
        $id
    )
    {
        if (!$customer = Customer::find($id)) {
            return $this->error('Customer not found', 404);
        }

        return $this->success('Customer details', $customer);
    }

    /**
     * @param int|null $id
     * @param int $dealer_id
     * @param string $tax_number
     * @param string|null $name
     * @param string|null $password
     */
    public function save(
        $id,
        $dealer_id,
        $tax_number,
        $name,
        $email,
        $gsm
    )
    {
        $customer = $id ? Customer::find($id) : new Customer;

        if ($id && !$customer) {
            return $this->error('Customer not found', 404);
        }

        $customer->dealer_id = $dealer_id;
        $customer->tax_number = $tax_number;
        $customer->name = $name;
        $customer->email = $email;
        $customer->gsm = $gsm;
        $customer->save();

        return $this->success('Customer created successfully', $customer);
    }

    /**
     * @param int $id
     */
    public function drop(
        $id
    )
    {
        if (!$customer = Customer::find($id)) {
            return $this->error('Customer not found', 404);
        }

        return $this->success('Customer details', $customer->delete());
    }

    /**
     * @param string $tax_number
     * @param int $except_id
     */
    public function checkTaxNumber(
        $tax_number,
        $except_id = null
    )
    {
        $customer = Customer::withTrashed();

        if ($except_id) {
            $customer->where('id', '<>', $except_id);
        }

        return $this->success('Checking customer tax number', $customer->where('tax_number', $tax_number)->first() ? 1 : 0);
    }

    /**
     * @param int $customer_id
     * @param int $transaction_status_id
     */
    public function updateTransactionStatus(
        $customer_id,
        $transaction_status_id
    )
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return $this->error('Customer not found', 404);
        }

        $customer->transaction_status_id = $transaction_status_id;
        $customer->save();

        return $this->success('Customer transaction status updated successfully', $customer_id);
    }
}
