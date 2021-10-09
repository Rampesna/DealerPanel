<?php

namespace App\Http\Controllers\Api\Dealer;

use App\Http\Controllers\Controller;
use App\Services\CustomerService;
use App\Traits\Response;
use Illuminate\Http\Request;

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
        return $this->customerService->index($request->dealer->id);
    }

    public function datatable(Request $request)
    {
        return $this->customerService->datatable($request->dealer->id);
    }

    public function save()
    {

    }
}
