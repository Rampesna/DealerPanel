<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\CustomerSupportRequest\DatatableRequest;
use App\Services\SupportRequestService;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;

class CustomerSupportRequestController extends Controller
{
    use Response;

    private $supportRequestService;

    public function __construct()
    {
        $this->supportRequestService = new SupportRequestService;
    }

    public function datatable(DatatableRequest $request)
    {
        return $this->supportRequestService->datatable(
            $request->creator_type,
            Crypt::decrypt($request->creator_id)
        );
    }
}
