<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\IndexRequest;
use App\Http\Requests\Api\User\CustomerService\DatatableRequest;
use App\Http\Requests\Api\User\Receipt\SaveRequest;
use App\Services\ReceiptService;
use Illuminate\Support\Facades\Crypt;

class DealerReceiptController extends Controller
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
        return $this->receiptService->index(
            null,
            null,
            $request->relation_type,
            gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id)
        );
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->receiptService->datatable(
            null,
            null,
            $request->relation_type,
            gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id)
        );
    }

    /**
     * @param SaveRequest
     */
    public function save(SaveRequest $request)
    {
        return $this->receiptService->save(
            $request->id,
            get_class($request->user),
            $request->user->id,
            $request->relation_type,
            gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id),
            $request->direction,
            null,
            $request->price
        );
    }
}
