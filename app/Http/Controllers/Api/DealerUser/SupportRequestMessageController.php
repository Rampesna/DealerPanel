<?php

namespace App\Http\Controllers\Api\DealerUser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DealerUser\SupportRequestMessage\SaveRequest;
use App\Services\SupportRequestMessageService;
use App\Traits\Response;

class SupportRequestMessageController extends Controller
{
    use Response;

    private $supportRequestMessageService;

    public function __construct()
    {
        $this->supportRequestMessageService = new SupportRequestMessageService;
    }

    public function save(SaveRequest $request)
    {
        return $this->supportRequestMessageService->save(
            $request->id,
            $request->support_request_id,
            $request->creator_type,
            $request->creator_id,
            $request->message
        );
    }
}
