<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\RelationService\AcceptRequest;
use App\Http\Requests\Api\DealerUser\RelationService\DatatableRequest;
use App\Http\Requests\Api\DealerUser\RelationService\IndexRequest;
use App\Http\Requests\Api\DealerUser\RelationService\SaveRequest;
use App\Services\RelationServiceService;
use Illuminate\Support\Facades\Crypt;

class RelationServiceController extends Controller
{
    private $relationServiceService;

    public function __construct()
    {
        $this->relationServiceService = new RelationServiceService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        return $this->relationServiceService->index(Crypt::decrypt($request->customer_id), null, 2);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->relationServiceService->datatable(
            $request->relation_type,
            gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id),
            $request->transaction_status_id
        );
    }

    /**
     * @param SaveRequest $request
     */
    public function save(SaveRequest $request)
    {
        return $this->relationServiceService->save(
            $request->id,
            $request->creator_type,
            $request->creator_id,
            $request->relation_type,
            gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id),
            $request->service_id,
            $request->start,
            $request->end,
            $request->amount,
            $request->status_id
        );
    }

    public function updateTransactionStatus(AcceptRequest $request)
    {
        return $this->relationServiceService->updateTransactionStatus(
            $request->relation_service_id,
            $request->transaction_status_id
        );
    }
}
