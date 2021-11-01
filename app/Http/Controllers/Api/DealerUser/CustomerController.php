<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Customer\SaveRequest;
use App\Http\Requests\Api\DealerUser\Customer\ShowRequest;
use App\Services\CustomerService;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CustomerController extends Controller
{
    use Response;

    private $customerService;

    public function __construct()
    {
        $this->customerService = new CustomerService;
    }

    public function index(Request $request)
    {
        return $this->customerService->index(2, $request->dealer_id);
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable(null, $request->dealer_id);
    }

    public function show(ShowRequest $request)
    {
        return $this->customerService->show(gettype($request->id) == 'integer' ? $request->id : Crypt::decrypt($request->id));
    }

    public function save(SaveRequest $request)
    {
        return $this->customerService->save(
            $request->id,
            $request->dealer_id,
            $request->name,
            $request->tax_number,
            $request->tax_office,
            $request->email,
            $request->gsm,
            $request->website,
            $request->country_id,
            $request->province_id,
            $request->district_id,
            $request->foundation_date
        );
    }
}
