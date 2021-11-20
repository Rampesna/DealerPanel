<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\DatatableRequest;
use App\Http\Requests\Api\User\CustomerService\IndexRequest;
use App\Http\Requests\Api\User\CustomerService\ShowRequest;
use App\Http\Requests\Api\User\CustomerService\SaveRequest;
use App\Http\Requests\Api\User\CustomerService\DropRequest;
use App\Services\RelationServiceService;
use Illuminate\Support\Facades\Crypt;

class DealerServiceController extends Controller
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
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->relationServiceService->index(
            $request->relation_type,
            $relation_id,
            $request->transaction_status_id
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
        return $this->relationServiceService->datatable(
            $request->relation_type,
            $relation_id,
            $request->transaction_status_id
        );
    }

    /**
     * @param ShowRequest $request
     */
    public function show(ShowRequest $request)
    {
        return $this->relationServiceService->show($request->id);
    }

    /**
     * @param SaveRequest $request
     */
    public function save(SaveRequest $request)
    {
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->relationServiceService->save(
            $request->id,
            $request->creator_type,
            $request->creator_id,
            $request->relation_type,
            $relation_id,
            $request->service_id,
            $request->start,
            $request->end,
            $request->amount,
            $request->status_id
        );
    }

    /**
     * @param DropRequest $request
     */
    public function drop(DropRequest $request)
    {
        return $this->relationServiceService->drop($request->id);
    }
}
