<?php

namespace App\Services;

use App\Models\ContractStatus;
use App\Traits\Response;

class ContractStatusService
{
    use Response;

    public function index()
    {
        return $this->success('Contract statuses', ContractStatus::all());
    }
}
