<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Dealer\DropRequest;
use App\Http\Requests\Api\User\Dealer\SaveRequest;
use App\Http\Requests\Api\User\Dealer\ShowRequest;
use App\Http\Requests\Api\User\Dealer\JsTreeRequest;
use App\Services\DealerService;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DealerController extends Controller
{
    use Response;

    private $dealerService;

    public function __construct()
    {
        $this->dealerService = new DealerService;
    }

    public function all(Request $request)
    {
        return $this->dealerService->all($request->transaction_status_id);
    }

    public function index(Request $request)
    {
        return $this->dealerService->index($request->dealer_id, $request->transaction_status_id);
    }

    public function datatable(Request $request)
    {
        return $this->dealerService->datatable($request->dealer_id, $request->transaction_status_id);
    }

    public function jsTree(JsTreeRequest $request)
    {
        return $this->dealerService->jsTree([Crypt::decrypt($request->dealer_id)], $request->transaction_status_id);
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
