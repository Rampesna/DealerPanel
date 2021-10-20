<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Credit\DatatableRequest;
use App\Http\Requests\Api\Customer\Credit\IndexRequest;
use App\Services\CreditService;
use Illuminate\Support\Facades\Crypt;

class CreditController extends Controller
{
    private $creditService;

    public function __construct()
    {
        $this->creditService = new CreditService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        return $this->creditService->index($request->relation_type, $request->relation_id);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->creditService->datatable($request->relation_type, $request->relation_id);
    }
}
