<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Customer\Receipt\DatatableRequest;
use App\Http\Requests\Api\Customer\Receipt\IndexRequest;
use App\Services\ReceiptService;

class ReceiptController extends Controller
{
    private $receiptService;

    public function __construct()
    {
        $this->receiptService = new ReceiptService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        return $this->receiptService->index(null, null, $request->relation_type, $request->relation_id);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->receiptService->datatable(null, null, $request->relation_type, $request->relation_id);
    }
}
