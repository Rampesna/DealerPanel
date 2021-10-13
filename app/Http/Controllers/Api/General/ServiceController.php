<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\General\Service\IndexRequest;
use App\Services\ServiceService;

class ServiceController extends Controller
{
    private $serviceService;

    public function __construct()
    {
        $this->serviceService = new ServiceService;
    }

    public function index(IndexRequest $request)
    {
        return $this->serviceService->index();
    }
}
