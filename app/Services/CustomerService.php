<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Dealer;
use App\Models\Province;
use App\Models\TransactionStatus;
use App\SoapServices\BienSoapService;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;

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
     * @param string $tax_number
     */
    public function oAuthLoginWithTaxNumber(
        $tax_number
    )
    {
        $customer = Customer::where('tax_number', $tax_number)->first();

        if (!$customer) {
            return $this->error('Customer not found');
        }

        Auth::guard('customer')->login($customer);

        return redirect()->route('customer.dashboard.index');
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
    public function indexWithServices(
        $transaction_status_id = null,
        $dealer_id = null
    )
    {
        $customers = Customer::with([
            'services' => function ($services) {
                $services->with([
                    'service'
                ]);
            }
        ]);

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
    public function searching(
        $keyword,
        $dealer_id = null
    )
    {
        $customers = Customer::with([])->where('transaction_status_id', 2);

        if ($dealer_id) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds($dealer_id));
        }

        if ($keyword) {
            $customers->where(function ($customers) use ($keyword) {
                $customers
                    ->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('tax_number', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%');
            });
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
        $customers = Customer::with([
            'credits'
        ]);

        if ($transaction_status_id) {
            $customers->where('transaction_status_id', $transaction_status_id);
        }

        if ($dealer_id != null) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds(intval($dealer_id)));
        }

        return DataTables::of($customers)->
        filterColumn('dealer_id', function ($customers, $data) {
            return $customers->whereIn('dealer_id', Dealer::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('transaction_status', function ($customers, $data) {
            return $customers->whereIn('transaction_status_id', TransactionStatus::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        filterColumn('province_id', function ($customers, $data) {
            return $customers->whereIn('province_id', Province::where('name', 'like', '%' . $data . '%')->pluck('id')->toArray());
        })->
        editColumn('dealer_id', function ($customer) {
            return $customer->dealer ? $customer->dealer->name : '';
        })->
        editColumn('province_id', function ($customer) {
            return $customer->province ? $customer->province->name : '';
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
        if (!$customer = Customer::with([
            'dealer',
            'country',
            'province',
            'district'
        ])->find($id)) {
            return $this->error('Customer not found', 404);
        }

        return $this->success('Customer details', $customer);
    }

    /**
     * @param int|null $id
     * @param int $dealer_id
     * @param string $name
     * @param string $tax_number
     * @param string|null $tax_office
     * @param string|null $email
     * @param string|null $gsm
     * @param string|null $website
     * @param int|null $country_id
     * @param int|null $province_id
     * @param int|null $district_id
     * @param string $foundation_date
     * @param float $divisor
     */
    public function save(
        $id,
        $dealer_id,
        $name,
        $tax_number,
        $tax_office,
        $email,
        $gsm,
        $website,
        $country_id,
        $province_id,
        $district_id,
        $foundation_date,
        $divisor = 1
    )
    {
        $customer = $id ? Customer::find($id) : new Customer;

        if ($id && !$customer) {
            return $this->error('Customer not found', 404);
        }

        $bienSoapService = new BienSoapService;
        $customerFromSoapService = $bienSoapService->GetCustomerStatusInformation();
        $activationDate = '';
        if (isset($customerFromSoapService->GetCustomerStatusInformationResult->Value->Items->CreateDateUtc)) {
            $carbonDate = new Carbon($customerFromSoapService->GetCustomerStatusInformationResult->Value->Items->CreateDateUtc);
            $activationDate = $carbonDate->toDateTimeString();
        }

        $customer->dealer_id = $dealer_id;
        $customer->name = $name;
        $customer->tax_number = $tax_number;
        $customer->tax_office = $tax_office;
        $customer->email = $email;
        $customer->gsm = $gsm;
        $customer->website = $website;
        $customer->country_id = $country_id;
        $customer->province_id = $province_id;
        $customer->district_id = $district_id;
        $customer->foundation_date = $foundation_date;
        $customer->divisor = $divisor == '' || $divisor == null ? 1 : $divisor;
        $customer->activation_date = $activationDate;
        $customer->save();

        return $this->success('Customer created successfully', $customer);
    }

    public function importWithExcel($file)
    {
        $response = [];
        $name = date('YmdHis') . '.xlsx';
        $path = storage_path('/customersImports/');
        $file->move($path, $name);
        $customers = Excel::toCollection(null, $path . $name);

        foreach ($customers as $customer) {
            $response[] = [
                'dealer_id' => null,
                'name' => $customer[0],
                'tax_number' => $customer[1],
                'tax_office' => $customer[2],
                'email' => $customer[3],
                'gsm' => $customer[4],
                'website' => $customer[5],
                'transaction_status_id' => 2,
            ];
        }

        return $response;

        return Customer::insert($response);
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

        if ($transaction_status_id == 2) {
            $password = Str::random(8);
            $customer->password = bcrypt($password);
            // Mail::to($customer->email)->send(new SendCustomerPasswordEmail($customer->name, $customer->tax_number, $password));
        }

        $customer->save();

//        $bienCrmCustomerService = new \App\BienCrmServices\CustomerService;
//        $bienCrmCustomerService->create($customer);

        return $this->success('Customer transaction status updated successfully', []);
    }

    /**
     * @param array $customer_ids
     * @param int $dealer_id
     */
    public function updateDealer(
        $customer_ids,
        int $dealer_id
    )
    {
        foreach ($customer_ids as $customer_id) {
            $customer = Customer::find($customer_id);
            $customer->dealer_id = $dealer_id;
            $customer->save();
        }

        return $this->success('Customers dealer ids successfully updated', null);
    }

    /**
     * @param int|null $dealer_id
     */
    public function creditReportDatatable(
        $dealer_id = null
    )
    {
        $customers = Customer::with([
            'credits'
        ]);

        if ($dealer_id != null) {
            $customers->whereIn('dealer_id', (new DealerService)->getSubDealersIds(intval($dealer_id)));
        }

        return DataTables::of($customers)->
        addColumn('total', function ($customer) {
            return $customer->credits->where('direction', 1)->sum('amount');
        })->
        addColumn('used', function ($customer) {
            $bienSoapService = new BienSoapService;
            $response = $bienSoapService->GetCustomerReportWithSoftware(
                '2000-01-01',
                '2050-01-01',
                $customer->tax_number
            );

            $usage = 0;

            if (isset($response->GetCustomerReportWithSoftwareResult->Value)) {
                if (is_array($response->GetCustomerReportWithSoftwareResult->Value->Usages)) {
                    foreach ($response->GetCustomerReportWithSoftwareResult->Value->Usages as $usageItem) {
                        $usage += $usageItem->Items->Count;
                    }
                } else {
                    $usage = $response->GetCustomerReportWithSoftwareResult->Value->Usages->Items->Count;
                }
            }

            return $usage;
        })->
        addColumn('remaining', function ($customer) {
            return $customer->credits->where('direction', 1)->sum('amount') - $customer->credits->where('direction', 0)->sum('amount');
        })->
        make(true);
    }

    /**
     * @param int $customer_id
     * @param string $password
     */
    public function checkPassword(
        $customer_id,
        $password
    )
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return $this->error('Customer not found', 404);
        }

        return $this->success('Customer password check status', Hash::check($password, $customer->password) ? 1 : 0);
    }

    /**
     * @param int $customer_id
     * @param string $password
     */
    public function updatePassword(
        $customer_id,
        $password
    )
    {
        $customer = Customer::find($customer_id);

        if (!$customer) {
            return $this->error('Customer not found', 404);
        }

        $customer->password = $password;
        $customer->save();

        return $this->success('Customer password updated successfully', null);
    }
}
