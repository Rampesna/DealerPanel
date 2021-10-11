<?php

namespace App\Services;

use App\Models\SupportRequestPriority;
use App\Traits\Response;

class SupportRequestPriorityService
{
    use Response;

    public function index()
    {
        return $this->success('Support request priorities', SupportRequestPriority::all());
    }
}
