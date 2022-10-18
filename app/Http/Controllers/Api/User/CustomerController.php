<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Customer\DropRequest;
use App\Http\Requests\Api\User\Customer\SaveRequest;
use App\Http\Requests\Api\User\Customer\ImportWithExcelRequest;
use App\Http\Requests\Api\User\Customer\ShowRequest;
use App\Http\Requests\Api\User\Customer\UpdateDealerRequest;
use App\Http\Requests\Api\User\Customer\SearchingRequest;
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
        return $this->customerService->index($request->transaction_status_id, $request->dealer_id);
    }

    public function indexWithServices(Request $request)
    {
        return $this->customerService->indexWithServices($request->transaction_status_id, $request->dealer_id);
    }

    public function searching(SearchingRequest $request)
    {
        return $this->customerService->searching($request->keyword);
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable(2, $request->dealer_id ? Crypt::decrypt($request->dealer_id) : null);
    }

    public function show(ShowRequest $request)
    {
        try {
            $id = Crypt::decrypt($request->id);
        } catch (\Exception $exception) {
            $id = $request->id;
        }
        return $this->customerService->show($id);
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
            $request->foundation_date,
            $request->divisor
        );
    }

    public function importWithExcel(ImportWithExcelRequest $request)
    {
        return $this->customerService->importWithExcel(
            $request->file('file')
        );
    }

    public function drop(DropRequest $request)
    {
        $this->customerService->drop($request->id);
    }

    public function updateDealer(UpdateDealerRequest $request)
    {
        return $this->customerService->updateDealer($request->customer_ids, $request->dealer_id);
    }
}
