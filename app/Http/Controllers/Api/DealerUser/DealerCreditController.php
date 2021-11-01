<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\RelationService\IndexRequest;
use App\Http\Requests\Api\DealerUser\RelationService\DatatableRequest;
use App\Services\CreditService;
use Illuminate\Support\Facades\Crypt;

class DealerCreditController extends Controller
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
        return $this->creditService->index(
            $request->relation_type,
            Crypt::decrypt($request->relation_id),
            null
        );
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->creditService->datatable(
            $request->relation_type,
            Crypt::decrypt($request->relation_id),
            null
        );
    }
}
