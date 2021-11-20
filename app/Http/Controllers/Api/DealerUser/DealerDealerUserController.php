<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\DealerUser\IndexRequest;
use App\Http\Requests\Api\DealerUser\DealerUser\DatatableRequest;
use App\Http\Requests\Api\DealerUser\DealerUser\ShowRequest;
use App\Http\Requests\Api\DealerUser\DealerUser\SaveRequest;
use App\Http\Requests\Api\DealerUser\DealerUser\DropRequest;
use App\Http\Requests\Api\DealerUser\DealerUser\SendPasswordRequest;
use App\Services\DealerUserService;
use Illuminate\Support\Facades\Crypt;

class DealerDealerUserController extends Controller
{
    private $dealerUserService;

    public function __construct()
    {
        $this->dealerUserService = new DealerUserService;
    }

    /**
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        try {
            $dealer_id = Crypt::decrypt($request->dealer_id);
        } catch (\Exception $exception) {
            $dealer_id = $request->dealer_id;
        }
        return $this->dealerUserService->index($dealer_id);
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        try {
            $dealer_id = Crypt::decrypt($request->dealer_id);
        } catch (\Exception $exception) {
            $dealer_id = $request->dealer_id;
        }
        return $this->dealerUserService->datatable($dealer_id);
    }

    /**
     * @param ShowRequest $request
     */
    public function show(ShowRequest $request)
    {
        return $this->dealerUserService->show($request->id);
    }

    /**
     * @param SaveRequest $request
     */
    public function save(SaveRequest $request)
    {
        try {
            $dealer_id = Crypt::decrypt($request->dealer_id);
        } catch (\Exception $exception) {
            $dealer_id = $request->dealer_id;
        }
        return $this->dealerUserService->save(
            $request->id,
            $dealer_id,
            $request->name,
            $request->email
        );
    }

    /**
     * @param DropRequest $request
     */
    public function drop(DropRequest $request)
    {
        return $this->dealerUserService->drop($request->id);
    }

    /**
     * @param SendPasswordRequest $request
     */
    public function sendPassword(SendPasswordRequest $request)
    {
        return $this->dealerUserService->sendPassword($request->id);
    }
}
