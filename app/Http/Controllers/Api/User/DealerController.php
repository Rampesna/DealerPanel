<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\Dealer\DropRequest;
use App\Http\Requests\Api\User\Dealer\SaveRequest;
use App\Http\Requests\Api\User\Dealer\ShowRequest;
use App\Http\Requests\Api\User\Dealer\JsTreeRequest;
use App\Services\DealerService;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class DealerController extends Controller
{
    use Response;

    private $dealerService;

    public function __construct()
    {
        $this->dealerService = new DealerService;
    }

    public function index()
    {
        return $this->dealerService->index();
    }

    public function datatable()
    {
        return $this->dealerService->datatable();
    }

    public function jsTree(JsTreeRequest $request)
    {
        return $this->dealerService->jsTree([Crypt::decrypt($request->dealer_id)]);
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
        );
    }

    public function drop(DropRequest $request)
    {
        $this->dealerService->drop($request->id);
    }
}
