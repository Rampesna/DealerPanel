<?php

namespace App\Services;

use App\Models\CustomerServiceStatus;
use App\Traits\Response;

class CustomerServiceStatusService
{
    use Response;

    public function index()
    {
        return $this->success('Customer service statuses', CustomerServiceStatus::all());
    }
}
