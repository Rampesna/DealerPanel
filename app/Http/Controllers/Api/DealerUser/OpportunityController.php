<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\Opportunity\DatatableRequest;
use App\Http\Requests\Api\DealerUser\Opportunity\IndexRequest;
use App\Http\Requests\Api\DealerUser\Opportunity\SaveRequest;
use App\Http\Requests\Api\DealerUser\Opportunity\ShowRequest;
use App\Services\OpportunityService;
use App\Traits\Response;

class OpportunityController extends Controller
{
    use Response;

    private $opportunityService;

    public function __construct()
    {
        $this->opportunityService = new OpportunityService;
    }

    public function index(IndexRequest $request)
    {
        return $this->opportunityService->index(
            $request->creator_type,
            $request->creator_id
        );
    }

    public function datatable(DatatableRequest $request)
    {
        return $this->opportunityService->datatable(
            $request->creator_type,
            $request->creator_id,
            $request->dealer_id
        );
    }

    public function show(ShowRequest $request)
    {
        return $this->opportunityService->show($request->id);
    }

    public function save(SaveRequest $request)
    {
        return $this->opportunityService->save(
            $request->id,
            $request->creator_type,
            $request->creator_id,
            $request->dealer_id,
            $request->name,
            $request->tax_number,
            $request->tax_office,
            $request->email,
            $request->gsm,
            $request->description,
            $request->country_id,
            $request->province_id,
            $request->district_id,
            $request->status_id,
            $request->date
        );
    }
}
