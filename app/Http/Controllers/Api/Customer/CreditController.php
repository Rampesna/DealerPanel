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
        try {
            $relation_id = Crypt::decrypt($request->relation_id);
        } catch (\Exception $exception) {
            $relation_id = $request->relation_id;
        }
        return $this->creditService->index($request->relation_type, $relation_id);
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
        return $this->creditService->datatable($request->relation_type, $relation_id);
    }
}
