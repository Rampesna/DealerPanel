<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\Dealer\CheckTaxNumberRequest;
use App\Services\DealerService;

class DealerController extends Controller
{
    private $dealerService;

    public function __construct()
    {
        $this->dealerService = new DealerService;
    }

    public function checkTaxNumber(CheckTaxNumberRequest $request)
    {
        return $this->dealerService->checkTaxNumber($request->tax_number, $request->except_id);
    }
}
