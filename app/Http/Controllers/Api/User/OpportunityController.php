<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Opportunity\DatatableRequest;
use App\Http\Requests\Api\User\Opportunity\IndexRequest;
use App\Http\Requests\Api\User\Opportunity\SaveRequest;
use App\Http\Requests\Api\User\Opportunity\ShowRequest;
use App\Http\Requests\Api\User\Opportunity\DropRequest;
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
        return $this->opportunityService->index();
    }

    public function datatable(DatatableRequest $request)
    {
        return $this->opportunityService->datatable();
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

    public function drop(DropRequest $request)
    {
        return $this->opportunityService->drop($request->id);
    }
}
