<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Customer\DropRequest;
use App\Http\Requests\Api\User\Customer\SaveRequest;
use App\Http\Requests\Api\User\Customer\ShowRequest;
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

    public function index()
    {
        return $this->customerService->index();
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable(2);
    }

    public function show(ShowRequest $request)
    {
        return $this->customerService->show($request->id);
    }

    public function save(SaveRequest $request)
    {
        return $this->customerService->save(
            $request->id,
            $request->dealer_id,
            $request->tax_number,
            $request->name,
            $request->email,
            $request->gsm
        );
    }

    public function drop(DropRequest $request)
    {
        $this->customerService->drop($request->id);
    }
}
