<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Services\DealerService;
use App\Traits\Response;
use App\Http\Requests\Api\DealerUser\Dealer\IndexRequest;
use App\Http\Requests\Api\DealerUser\Dealer\DatatableRequest;

class DealerController extends Controller
{
    use Response;

    private $dealerService;

    public function __construct()
    {
        $this->dealerService = new DealerService;
    }

    public function all()
    {
        return $this->dealerService->all();
    }

    public function index(IndexRequest $request)
    {
        return $this->dealerService->index($request->dealer_id);
    }

    public function datatable(DatatableRequest $request)
    {
        return $this->dealerService->datatable($request->dealer_id);
    }
}
