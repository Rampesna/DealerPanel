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
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->receiptService->index(
            null,
            null,
            $request->relation_type,
            $relation_id
        );
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->receiptService->datatable(
            null,
            null,
            $request->relation_type,
            $relation_id
        );
    }

    /**
     * @param SaveRequest
     */
    public function save(SaveRequest $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->receiptService->save(
            $request->id,
            $request->creator_type,
            $request->creator_id,
            $request->relation_type,
            $relation_id,
            $request->direction,
            null,
            $request->price
        );
    }
}
