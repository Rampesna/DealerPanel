<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Dealer\DropRequest;
use App\Http\Requests\Api\DealerUser\Dealer\SaveRequest;
use App\Http\Requests\Api\DealerUser\Dealer\ShowRequest;
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
        return $this->dealerService->subDealers($request->dealer_id);
    }

    public function datatable(DatatableRequest $request)
    {
        return $this->dealerService->subDealersDatatable($request->dealer_id);
    }

    public function show(ShowRequest $request)
    {
        return $this->dealerService->show($request->id);
    }

    public function save(SaveRequest $request)
    {
        return $this->dealerService->save(
            $request->id,
            $request->top_id,
            $request->tax_number,
            $request->name,
            $request->email,
            $request->gsm,
            $request->tax_office,
            $request->website,
            $request->foundation_date,
            $request->country_id,
            $request->province_id,
            $request->district_id
        );
    }

    public function drop(DropRequest $request)
    {
        $this->dealerService->drop($request->id);
    }
}
