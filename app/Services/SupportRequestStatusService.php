<?php

namespace App\Services;

use App\Models\SupportRequestStatus;
use App\Traits\Response;

class SupportRequestStatusService
{
    use Response;

    public function index()
    {
        return $this->success('Support request statuses', SupportRequestStatus::all());
    }
}
