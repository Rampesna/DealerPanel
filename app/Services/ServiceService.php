<?php

namespace App\Services;

use App\Models\Service;
use App\Traits\Response;

class ServiceService
{
    use Response;

    public function index()
    {
        return $this->success('Services', Service::all());
    }
}
