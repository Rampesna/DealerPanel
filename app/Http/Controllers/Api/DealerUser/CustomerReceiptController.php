<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Receipt\DatatableRequest;
use App\Http\Requests\Api\DealerUser\Receipt\IndexRequest;
use App\Services\ReceiptService;
use Illuminate\Support\Facades\Crypt;

class CustomerReceiptController extends Controller
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
        return $this->receiptService->index(null, null, $request->relation_type, Crypt::decrypt($request->relation_id));
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->receiptService->datatable(null, null, $request->relation_type, Crypt::decrypt($request->relation_id));
    }
}
