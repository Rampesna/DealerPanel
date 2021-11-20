<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CreditDetail\IndexRequest;
use App\Http\Requests\Api\User\CreditDetail\DatatableRequest;
use App\Http\Requests\Api\User\CreditDetail\SaveRequest;
use App\Services\CreditDetailService;
use Illuminate\Support\Facades\Crypt;

class CreditDetailController extends Controller
{
    private $creditDetailService;

    public function __construct()
    {
        $this->creditDetailService = new CreditDetailService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        return $this->creditDetailService->index($request->credit_id);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->creditDetailService->datatable($request->credit_id);
    }

    /**
     * @param SaveRequest $request
     */
    public function save(SaveRequest $request)
    {
        return $this->creditDetailService->save(
            $request->id,
            $request->credit_id,
            $request->type_id,
            $request->amount
        );
    }
}
