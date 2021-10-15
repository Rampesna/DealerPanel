<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerService\IndexRequest;
use App\Services\CreditService;
use Illuminate\Support\Facades\Crypt;

class CustomerCreditController extends Controller
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
            gettype($request->relation_id) == 'integer' ? $request->relation_id : Crypt::decrypt($request->relation_id),
            null
        );
    }
}
