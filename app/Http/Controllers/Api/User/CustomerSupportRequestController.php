<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CustomerSupportRequest\DatatableRequest;
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
        try {
            $creator_id = Crypt::decrypt($request->creator_id);
        } catch (\Exception $exception) {
            $creator_id = $request->creator_id;
        }
        return $this->supportRequestService->datatable(
            $request->creator_type,
            $creator_id
        );
    }
}
