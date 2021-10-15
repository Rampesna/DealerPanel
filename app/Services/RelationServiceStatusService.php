<?php

namespace App\Services;

use App\Models\RelationServiceStatus;
use App\Traits\Response;

class RelationServiceStatusService
{
    use Response;

    public function index()
    {
        return $this->success('Customer service statuses', RelationServiceStatus::all());
    }
}
