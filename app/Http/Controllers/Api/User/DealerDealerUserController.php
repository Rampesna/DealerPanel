<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\DealerUser\IndexRequest;
use App\Http\Requests\Api\User\DealerUser\DatatableRequest;
use App\Http\Requests\Api\User\DealerUser\ShowRequest;
use App\Http\Requests\Api\User\DealerUser\SaveRequest;
use App\Http\Requests\Api\User\DealerUser\DropRequest;
use App\Http\Requests\Api\User\DealerUser\SendPasswordRequest;
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
        return $this->dealerUserService->index(gettype($request->dealer_id) == 'integer' ? $request->dealer_id : Crypt::decrypt($request->dealer_id));
    }

    /**
     * @param DatatableRequest $request
     */
    public function datatable(DatatableRequest $request)
    {
        return $this->dealerUserService->datatable(gettype($request->dealer_id) == 'integer' ? $request->dealer_id : Crypt::decrypt($request->dealer_id));
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
        return $this->dealerUserService->save(
            $request->id,
            gettype($request->dealer_id) == 'integer' ? $request->dealer_id : Crypt::decrypt($request->dealer_id),
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
