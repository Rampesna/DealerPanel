<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\ContractStatus\IndexRequest;
use App\Services\ContractStatusService;

class ContractStatusController extends Controller
{
    private $contractStatusService;

    public function __construct()
    {
        $this->contractStatusService = new ContractStatusService;
    }

    public function index(IndexRequest $request)
    {
        return $this->contractStatusService->index();
    }
}
